@include('common_header')

<title>Suimaq | Incidencias</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('') }}assets/global/plugins/xeditable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- END PAGE STYLES -->

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
			Incidencias
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-wrench"></i>
                        <a href="{{ url('incidencias') }}">Incidencias</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

            <input type="hidden" name="_token" value="{{ Session::getToken() }}">

			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-exclamation-triangle"></i>¡Urgentes!
					</div>
					<div class="tools">
						<a href="javascript:" class="collapse">
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-responsive">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Contacto</th>
                                <th>Dirección</th>
                                <th>Máquina</th>
                                <th>Estado</th>
                                <th>Contrato</th>
                                <th>Descripción</th>
                                <th>Obs. máquina</th>
                                <th>Obs. cliente</th>
                                <th>#OF</th>
                                <th>Material</th>
                                <th style="min-width:54px;"></th>
                            </tr>
                            </thead>
                            <tbody class="tBodyIncidencias">
                            <?php $i = 1; ?>
                            @foreach($urgentes as $incidencia)
                                <tr class="trIncidencias" data-id="{{ $incidencia->id }}">
                                    <td>
                                        {{ $i }}
                                    </td>
                                    <td>
                                        <a href="{{ url('clientes/ver?id='.$incidencia->cliente()->pluck('id')) }}">
                                            {{ $incidencia->cliente()->pluck('nombre') }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $incidencia->cliente()->pluck('tlf_contacto') }}">
                                            {{ $incidencia->cliente()->pluck('tlf_contacto') }}
                                        </a>
                                        ({{ $incidencia->cliente()->pluck('persona_contacto') }})
                                    </td>
                                    <td>
                                        {{ $incidencia->cliente()->pluck('direccion') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('clientes/maquinas/ver?id='.$incidencia->maquina()->pluck('id')) }}">
                                            {{ $incidencia->maquina()->pluck('marca') }}/{{ $incidencia->maquina()->pluck('modelo') }}
                                        </a>
                                        @if($incidencia->maquina()->pluck('no_serie') && $incidencia->maquina()->pluck('no_serie')!='') ({{ $incidencia->maquina()->pluck('no_serie') }}) @endif
                                    </td>
                                    <td class="tdEstadoIncidencia">
                                         <span class="label label-sm @if($incidencia->estado == 'Programada') bg-green @else label-warning @endif">
                                             {{ $incidencia->estado }}
                                         </span>
                                    </td>
                                    <td>
                                        @if($incidencia->contrato)
                                            <span class="label label-sm label-success">Contrato</span>
                                        @else
                                            <span class="label label-sm label-warning">Sin contrato</span>
                                        @endif
                                    </td>
                                    <td>@if(strlen($incidencia->tipo_intervencion->descripcion) > 12) {{ substr($incidencia->tipo_intervencion->descripcion,0,12).'...' }} @else {{ $incidencia->tipo_intervencion->descripcion }} @endif</td>
                                    <td>@if(strlen($incidencia->maquina->observaciones) > 12) {{ substr($incidencia->maquina->observaciones,0,12).'...' }} @else {{ $incidencia->maquina->observaciones }} @endif</td>
                                    <td>@if(strlen($incidencia->cliente->observaciones) > 12) {{ substr($incidencia->cliente->observaciones,0,12).'...' }} @else {{ $incidencia->cliente->observaciones }} @endif</td>
                                    <td>
                                        <span id="inline_no_of" data-pk="{{ $incidencia->id }}" class="inline-editable">{{ $incidencia->no_of }}</span>
                                    </td>
                                    <td>
                                        <a href="javascript:" class="btn default btn-xs green-stripe
                                        @if($incidencia->check_material==1) hidden @endif
                                        @if($incidencia->estado == 'Programada') disabled @endif " data-toggle="modal" data-target="#matsModal{{$i}}">
                                            Confirmar
                                        </a>
                                        <a href="javascript:" class="btn default btn-xs red-stripe
                                        @if($incidencia->check_material==0) hidden @endif
                                        @if($incidencia->estado == 'Programada') disabled @endif " data-toggle="modal" data-target="#matsModal{{$i}}">
                                            Cancelar
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="matsModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="matsModal{{$i}}lbl">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Check material - </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Referencia</th>
                                                                <th>Cantidad</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($incidencia->maquina->piezas()->where('tipo_intervenciones_id',$incidencia->tipo_intervenciones_id)->get() as $pieza)
                                                                <tr>
                                                                    <td>{{$pieza->nombre}}</td>
                                                                    <td>{{$pieza->referencia}}</td>
                                                                    <td>{{$pieza->cantidad}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-xs-6 text-left">
                                                                <a data-pk="{{ $incidencia->id }}" href="javascript:" class="btn btn-primary btn-check-mats-confirm @if($incidencia->check_material==1) hidden @endif" data-dismiss="modal">
                                                                    Confirmar
                                                                </a>
                                                                <a data-pk="{{ $incidencia->id }}" href="javascript:" class="btn btn-danger btn-check-mats-cancel @if($incidencia->check_material==0) hidden @endif" data-dismiss="modal">
                                                                    Cancelar confirmación
                                                                </a>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <a href="javascript:" class="btn btn-default" data-dismiss="modal">Volver</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('/incidencias/ver?id='.$incidencia->id) }}" class="btn default btn-xs blue-stripe" style="margin:0;"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('/incidencias/editar?id='.$incidencia->id) }}" class="btn default btn-xs purple-stripe" style="margin:0;"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <?php ++$i; ?>
                            @endforeach
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
			<!-- END URGENTES TABLE PORTLET-->

			<!-- BEGIN NORMAL TABLE PORTLET-->
			<div class="portlet">
				<div class="portlet-body">
					<div class="table-toolbar" style="margin: 35px 0 10px 0;">
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
									<a href="{{ url('/incidencias/nueva') }}" class="btn green"><i class="fa fa-plus"></i> Nueva incidencia</a>
								</div>
							</div>

						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Contacto</th>
                                    <th>Dirección</th>
                                    <th>Máquina</th>
                                    <th>Estado</th>
                                    <th>Contrato</th>
                                    <th>Descripción</th>
                                    <th>Obs. máquina</th>
                                    <th>Obs. cliente</th>
                                    <th>#OF</th>
                                    <th>Material</th>
                                    <th style="min-width:54px;"></th>
                                </tr>
                            </thead>
                            <tbody class="tBodyIncidencias">
                                @foreach($incidencias as $incidencia)
                                <tr class="trIncidencias" data-id="{{ $incidencia->id }}">
                                    <td>
                                        {{ $i }}
                                    </td>
                                    <td>
                                        <a href="{{ url('clientes/ver?id='.$incidencia->cliente()->pluck('id')) }}">
                                            {{ $incidencia->cliente()->pluck('nombre') }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $incidencia->cliente()->pluck('tlf_contacto') }}">
                                            {{ $incidencia->cliente()->pluck('tlf_contacto') }}
                                        </a>
                                        ({{ $incidencia->cliente()->pluck('persona_contacto') }})
                                    </td>
                                    <td>
                                        {{ $incidencia->cliente()->pluck('direccion') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('clientes/maquinas/ver?id='.$incidencia->maquina()->pluck('id')) }}">
                                            {{ $incidencia->maquina()->pluck('marca') }}/{{ $incidencia->maquina()->pluck('modelo') }}
                                        </a>
                                        @if($incidencia->maquina()->pluck('no_serie') && $incidencia->maquina()->pluck('no_serie')!='') ({{ $incidencia->maquina()->pluck('no_serie') }}) @endif
                                    </td>
                                    <td class="tdEstadoIncidencia">
                                         <span class="label label-sm @if($incidencia->estado == 'Programada') bg-green @else label-warning @endif">
                                             {{ $incidencia->estado }}
                                         </span>
                                    </td>
                                    <td>
                                        @if($incidencia->contrato)
                                            <span class="label label-sm label-success">Contrato</span>
                                        @else
                                            <span class="label label-sm label-warning">Sin contrato</span>
                                        @endif
                                    </td>
                                    <td>@if(strlen($incidencia->tipo_intervencion->descripcion) > 12) {{ substr($incidencia->tipo_intervencion->descripcion,0,12).'...' }} @else {{ $incidencia->tipo_intervencion->descripcion }} @endif</td>
                                    <td>@if(strlen($incidencia->maquina->observaciones) > 12) {{ substr($incidencia->maquina->observaciones,0,12).'...' }} @else {{ $incidencia->maquina->observaciones }} @endif</td>
                                    <td>@if(strlen($incidencia->cliente->observaciones) > 12) {{ substr($incidencia->cliente->observaciones,0,12).'...' }} @else {{ $incidencia->cliente->observaciones }} @endif</td>
                                    <td>
                                        <span id="inline_no_of" @if($incidencia->estado == 'Programada') data-disabled="true" @endif data-pk="{{ $incidencia->id }}" class="inline-editable">{{ $incidencia->no_of }}</span>
                                    </td>
                                    <td>
                                        <a href="javascript:" class="btn default btn-xs green-stripe btn-mats-modal-confirm
                                        @if($incidencia->check_material==1) hidden @endif
                                        @if($incidencia->estado == 'Programada') disabled @endif " data-toggle="modal" data-target="#matsModal{{$i}}">
                                            Confirmar
                                        </a>
                                        <a href="javascript:" class="btn default btn-xs red-stripe btn-mats-modal-cancel
                                        @if($incidencia->check_material==0) hidden @endif
                                        @if($incidencia->estado == 'Programada') disabled @endif " data-toggle="modal" data-target="#matsModal{{$i}}">
                                            Cancelar
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="matsModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="matsModal{{$i}}lbl">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Check material</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Referencia</th>
                                                                <th>Cantidad</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($incidencia->maquina->piezas()->where('tipo_intervenciones_id',$incidencia->tipo_intervenciones_id)->get() as $pieza)
                                                            <tr>
                                                                <td>{{$pieza->nombre}}</td>
                                                                <td>{{$pieza->referencia}}</td>
                                                                <td>{{$pieza->cantidad}}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-xs-6 text-left">
                                                                <a data-pk="{{ $incidencia->id }}" href="javascript:" class="btn btn-primary btn-check-mats-confirm @if($incidencia->check_material==1) hidden @endif" data-dismiss="modal">
                                                                    Confirmar
                                                                </a>
                                                                <a data-pk="{{ $incidencia->id }}" href="javascript:" class="btn btn-danger btn-check-mats-cancel @if($incidencia->check_material==0) hidden @endif" data-dismiss="modal">
                                                                    Cancelar confirmación
                                                                </a>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <a href="javascript:" class="btn btn-default" data-dismiss="modal">Volver</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('/incidencias/ver?id='.$incidencia->id) }}" class="btn default btn-xs blue-stripe" style="margin:0;"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('/incidencias/editar?id='.$incidencia->id) }}" class="btn default btn-xs purple-stripe" style="margin:0;"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <?php ++$i; ?>
                                @endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->

		</div>
	</div>
	<!-- END CONTENT -->
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
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/xeditable/dist/bootstrap3-editable/js/bootstrap-editable.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features

    $('.btn-check-mats-confirm').click(function() {
        $(this).closest('.modal').modal('hide');
        var pk = $(this).attr('data-pk');
        var success = checkMats(pk, 'true');
        if(success===false)
            return false;
        //toggle in modal confirm/cancel btn
        $(this).addClass('hidden').next().removeClass('hidden');
        //toggle incidences table confirm/cancel btn
        $(this).closest('tr').find('.btn-mats-modal-confirm').addClass('hidden').next().removeClass('hidden');
    });
    $('.btn-check-mats-cancel').click(function() {
        $(this).closest('.modal').modal('hide');
        var pk = $(this).attr('data-pk');
        var success = checkMats(pk, 'false');
        if(success===false)
            return false;
        //toggle in modal confirm/cancel btn
        $(this).addClass('hidden').prev().removeClass('hidden');
        //toggle incidences table confirm/cancel btn
        $(this).closest('tr').find('.btn-mats-modal-confirm').removeClass('hidden').next().addClass('hidden');
    });
    function checkMats(id, state) {
        $.post('/incidencias/updateMaterial', {
            _token: $('input[name=_token]').val(),
            pk: id,
            material: state
        }, function(response) {
            if(response.success) {
                var labelColor = 'label-warning';
                if(response.newEstado == 'Programada')
                    labelColor = 'bg-green';
                $('tr[data-id='+response.idIncidencia+']')
                        .find('td.tdEstadoIncidencia')
                        .empty()
                        .append('<span class="label label-sm ' + labelColor + '">'+response.newEstado+'</span>');
                toastr['success'](response.success, response.title, {
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
                return true;
            } else if(response.error) {
                toastr['error'](response.error, response.title, {
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
                return false;
            }
        });
    }

    //x-editable
    $('.inline-editable').editable({
        url: '/incidencias/updateOF',
        type: 'text',
        params: { _token: $('input[name=_token]').val() },
        ajaxOptions: { type: 'post', dataType: 'json' },
        emptytext: 'Vacío',
        success: function(response, newValue) {
            var labelColor = 'label-warning';
            if(response.newEstado == 'Programada')
                labelColor = 'bg-green';
            if(response.success) {
                $('tr[data-id='+response.idIncidencia+']')
                    .find('td.tdEstadoIncidencia')
                    .empty()
                    .append('<span class="label label-sm ' + labelColor + '">'+response.newEstado+'</span>');
                toastr['success'](response.success, response.title, {
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
            } else if(response.warning) {
                var labelColor = 'label-warning';
                if(response.newEstado == 'Programada')
                    labelColor = 'bg-green';
                $('[data-id='+response.idIncidencia+']')
                    .find('.tdEstadoIncidencia')
                    .empty()
                    .append('<span class="label label-sm ' + labelColor + '">'+response.newEstado+'</span>');
                toastr['warning'](response.warning, response.title, {
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
            } else if(response.error) {
                toastr['error'](response.error, response.title, {
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
                return response.oldValue;
            }
        }
    });

    var trIncidence = $('.trIncidencias');
    var cntrlIsPressed = false;
    var hoverTrIncidence = false;
    var allowInfoOnClick = false;
    function toggleMoreInfoCursor() {
        //TODO: throttle this func? throttle keydown?. console.log(cntrlIsPressed+' '+hoverTrIncidence);
        if (cntrlIsPressed && hoverTrIncidence) {
            $('body').css('cursor', 'zoom-in');
            allowInfoOnClick = true;
        } else {
            $('body').css('cursor', 'default');
            allowInfoOnClick = false;
        }
    }
    $(this).keydown(function(e) {
        if(e.which=="17" || e.ctrlKey)
            cntrlIsPressed = true;
        toggleMoreInfoCursor();
    });
    $(this).keyup(function() {
        cntrlIsPressed = false;
        toggleMoreInfoCursor();
    });
    trIncidence.on('mouseover', function() {
        hoverTrIncidence = true;
        toggleMoreInfoCursor();
    }).on('mouseout', function() {
        hoverTrIncidence = false;
        toggleMoreInfoCursor();
    });

    $('.tBodyIncidencias').on('click','.trIncidencias', function(){
        if(!allowInfoOnClick)
            return true;
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
