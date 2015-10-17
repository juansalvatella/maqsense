@include('common_header')

<title>Suimaq | Inicio</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->


@include('common_theme_styles')

@include('common_navbar')

<!-- BEGIN CONTAINER -->
<div class="page-container">

    @include('common_left_sidebar')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Calendario
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="javascript:">Inicio</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->

            <input type="hidden" name="_token" value="{{ Session::getToken() }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box green-meadow calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-calendar"></i> Calendario
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                                    <h3 class="event-form-title">Pendientes de programar</h3>
                                    <div id="external-events">
                                        {{--<form class="inline-form">--}}
                                            {{--<input type="text" value="" class="form-control" placeholder="Event Title..." id="event_title"/><br/>--}}
                                            {{--<a href="javascript:;" id="event_add" class="btn default">--}}
                                                {{--Add Event </a>--}}
                                        {{--</form>--}}
                                        {{--<hr/>--}}

                                        <div id="event_box"></div>

                                        {{--<label for="drop-remove">--}}
                                            <input class="hidden" type="checkbox" id="drop-remove" checked aria-checked="true"/>
                                        {{--remove after drop </label>--}}
                                        <hr class="visible-xs"/>
                                    </div>
                                    <!-- END DRAGGABLE EVENTS PORTLET-->
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div id="calendar" class="has-toolbar">
                                    </div>
                                </div>
                            </div>
                            <!-- END CALENDAR PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
    <!-- END PAGE CONTENT-->
        </div>
    </div>
</div>
<!-- END CONTAINER -->
{{--Modals--}}
<div class="modal fade draggable-modal ui-draggable" id="incidence-info" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ui-draggable-handle">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">
                    <span id="cliente"></span>
                </h4>
			</div>
			<div class="modal-body">
                <strong>Dirección:</strong> <span id="direccion"></span><br>
                <strong>Persona de contacto:</strong> <span id="persona_contacto"></span><br>
                <strong>Teléfono:</strong> <span id="tlf_contacto"></span><br>
                <strong>Observaciones cliente:</strong> <span id="obs_cliente"></span><br><br>

                <strong>Máquina:</strong> <span id="maquina"></span><br>
                <strong>#OF:</strong> <span id="no_of"></span><br>
                <strong>Observaciones máquina:</strong> <span id="obs_maquina"></span><br><br>

                <strong>Mantenimiento:</strong> <span id="tipo_intervencion"></span> <span id="desc_intervencion"></span><br>
                <strong>Estado:</strong> <span id="estado"></span><br>
                <strong>Fecha prevista:</strong> <span id="fecha_prevista"></span><br>
                <strong>Fecha programada:</strong> <span id="fecha_programada"></span><br>
                <strong>Descripción incidencia:</strong> <span id="descripcion"></span><br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Volver</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
{{--End modals--}}

@include('common_footer')

@include('common_js')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('') }}assets/global/plugins/moment.min.js"></script>
<script src="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src='{{ asset('') }}assets/global/plugins/fullcalendar/lang/es.js'></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/calendar.js"></script>

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Calendar.init();

        var modalIncidences = $('#incidence-info');
        modalIncidences.on('hidden.bs.modal', function () {
            //
        });

        $('#external-events').on('click','.external-event', function(){
            $.ajax({
                url: '/requestIncidenceDetails',
                dataType: 'json',
                data: { id: $(this).attr('data-id') },
                success: function(data) {
                    var modalInfo = $('#incidence-info');
                    $.each(data, function(key, value) {
                        $('#'+key+'').empty().append(value);
                    });
                    modalInfo.modal('show');
                }
            });
        });

    });
</script>
@include('common_end')
