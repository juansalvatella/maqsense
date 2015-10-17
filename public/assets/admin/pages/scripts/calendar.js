var Calendar = function() {

    return {
        init: function() {
            Calendar.initCalendar(); //main function to initiate the module
        },

        initCalendar: function() {
            if (!jQuery().fullCalendar) {
                return;
            }

            var tokenVal = $('input[name=_token]').val();

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};
            if (Metronic.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = { right: 'title, prev, next', center: '', left: 'month,basicWeek' };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = { right: 'title', center: '', left: 'month,basicWeek, prev,next' };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = { left: 'title, prev, next', center: '', right: 'basicWeek,month' };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = { left: 'title', center: '', right: 'prev,next,basicWeek,month' };
                }
            }

            var initDrag = function(el) { //function to make external events draggable
                var eventObject = { // create an Event Object (it doesn't need to have a start or end)
                    title: $.trim(el.text()) // use the element's text as the event title
                };
                el.data('eventObject', eventObject); // store the Event Object in the DOM element so we can get to it later
                el.draggable({ // make the event draggable using jQuery UI
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its original position after the drag
                    dragRevertDuration: 0,
                    revertDuration: 0
                });
            };

            var addEvent = function(id, title, labelClass) { //function to create external events
                title = title.length === 0 ? "Untitled Event" : title;
                var html = $('<div class="external-event ' + labelClass + ' label" data-id="' + id + '">' + title + '</div>');
                jQuery('#event_box').append(html);
                initDrag(html);
            };

            $('#external-events div.external-event').each(function() {
                initDrag($(this));
            });

            $('#event_add').unbind('click').click(function() {
                var title = $('#event_title').val();
                addEvent(title);
            });

            var DELAY = 300, clicks = 0, timer = null;

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                header: h,
                defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
                editable: true,
                dragRevertDuration:0,
                droppable: true, // this allows things to be dropped onto the calendar
                eventDrop: function(event, delta, revertFunc) { //this function is called when an event is dropped from cell to cell (not external ones)
                    $.ajax({
                        url: '/programarIncidence',
                        type: 'POST',
                        dataType: 'json',
                        data: { _token: tokenVal, id: event.id, start: event.start.unix() },
                        success: function(data) {
                            console.log(data.msg);
                            if(typeof data.title !== 'undefined' && data.title == 'Modificación no permitida') {
                                revertFunc();
                                toastr['warning'](data.msg, data.title, {
                                    "closeButton": true,
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "showDuration": "1000",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                });
                            }
                        },
                        error: function(data) { revertFunc(); }
                    });

                },
                drop: function(date, allDay) { // this function is called when an external event is dropped (from external to calendar)
                    //FRONTEND MAGIC
                    var originalEventObject = $(this).data('eventObject'); // retrieve the dropped element's stored Event Object
                    var copiedEventObject = $.extend({}, originalEventObject); // we need to copy it, so that multiple events don't have a reference to the same object
                    copiedEventObject.start = date; // assign it the date that was reported
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.id = $(this).attr("data-id");
                    copiedEventObject.className = $(this).attr("data-class");
                    if ($(this).hasClass('label-urgente')) {
                        copiedEventObject.backgroundColor = '#bc4c3c';
                    } else if ($(this).hasClass('label-noauto')) {
                        copiedEventObject.backgroundColor = '#ff9747';
                    } else if ($(this).hasClass('label-auto')) {
                        copiedEventObject.backgroundColor = '#f2ce38';
                    }
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, false); // render the event on the calendar, the last `false` argument avoids duplicates when changing month
                    if ($('#drop-remove').is(':checked')) { $(this).remove(); } // if #drop-remove checbox is checked (it is), remove the element from the "Draggable Events" list
                    //BACKEND MAGIC
                    $.ajax({
                        url: '/programarIncidence',
                        type: 'POST',
                        dataType: 'json',
                        data: { _token: tokenVal, id: copiedEventObject.id, start: copiedEventObject.start.unix() },
                        success: function(data) { console.log(data.msg) },
                        error: function(data) { console.log(data.msg) }
                    });
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '/calendarFeed',
                        dataType: 'json',
                        data: { start: start.unix(), end: end.unix() },
                        success: function(data) {
                            var events = [];
                            for(var i = 0; i < data.length; ++i) {
                                events.push({
                                    id: data[i].id,
                                    title: data[i].title,
                                    start: data[i].start,
                                    allDay: data[i].allDay,
                                    backgroundColor: data[i].backgroundColor
                                });
                            }
                            callback(events);
                        }
                    });
                    $.ajax({
                        url: '/externalEventsFeed',
                        dataType: 'json',
                        data: { start: start.unix(), end: end.unix() },
                        success: function(data) {
                            $('#event_box').html("");
                            for(var i = 0; i < data.length; ++i) {
                                addEvent(data[i].id, data[i].title, data[i].labelClass);
                            }
                        }
                    });
                },
                eventClick: function(event) {
                    clicks++; //count clicks
                    if(clicks === 1) {
                        timer = setTimeout(function() {
                            $.ajax({ //single click action
                                url: '/requestIncidenceDetails',
                                dataType: 'json',
                                data: { id: event.id },
                                success: function(data) {
                                    var modalInfo = $('#incidence-info');
                                    $.each(data, function(key, value) {
                                        $('#'+key+'').empty().append(value);
                                    });
                                    modalInfo.modal('show');
                                }
                            });
                            clicks = 0;
                        }, DELAY);
                    } else { //prevent single-click action if double-clicking
                        clearTimeout(timer);
                        clicks = 0;
                    }
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $.ajax({
                            url: '/toggleIncidence',
                            type: 'POST',
                            dataType: 'json',
                            data: { _token: tokenVal, id: event.id },
                            success: function(data) {
                                console.log(data.msg);
                                event.backgroundColor = data.bgColor;
                                $(element).css("backgroundColor", data.bgColor);
                            },
                            error: function(data) { console.log(data.msg) }
                        });
                    });
                },
                eventDragStop: function(event,jsEvent) { //remove events from calendar and make them programables again (from calendar to external)
                    var trashEl = jQuery('#external-events');
                    var ofs = trashEl.offset();
                    var x1 = ofs.left;
                    var x2 = ofs.left + trashEl.outerWidth(true);
                    var y1 = ofs.top;
                    var y2 = ofs.top + trashEl.outerHeight(true);
                    if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 && jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {
                        //FRONTEND MAGIC
                        var labelClass = '';
                        if (event.backgroundColor == '#bc4c3c') {
                            labelClass = 'label-urgente';
                        } else if (event.backgroundColor == '#ff9747') {
                            labelClass = 'label-noauto';
                        } else if (event.backgroundColor == '#f2ce38') {
                            labelClass = 'label-auto';
                        }
                        $('#calendar').fullCalendar('removeEvents', event.id); //remove from calendar
                        addEvent(event.id, event.title, labelClass); //add to pendientes menu
                        $.ajax({
                            url: '/desprogramarIncidence',
                            type: 'POST',
                            dataType: 'json',
                            data: { _token: tokenVal, id: event.id },
                            success: function(data) {
                                if(typeof data.title !== 'undefined' && data.title == 'Modificación no permitida') {
                                    toastr['warning'](data.msg, data.title, {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-bottom-right",
                                        "onclick": null,
                                        "showDuration": "1000",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    });
                                    //revert
                                }
                            },
                            error: function(data) {
                                toastr['error']('Error inesperado al tratar de desprogramar incidencia. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación', 'Error', {
                                    "closeButton": true,
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "showDuration": "1000",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                });
                            }
                        });
                    }
                },
                loading: function(bool) {
                    if (bool) {
                        //$('#loading').show(); //TODO: loading layout
                    }
                    else {
                        //$('#loading').hide();
                    }
                }
            });

        }

    };

}();