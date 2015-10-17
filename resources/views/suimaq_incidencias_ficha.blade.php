@include('common_header')

@if(Request::is('incidencias/nueva*'))
    <title>Suimaq | Nueva incidencia</title>
@elseif(Request::is('incidencias/editar*'))
    <title>Suimaq |incidencias</title>
@elseif(Request::is('incidencias/ver*'))
    <title>Suimaq | incidencia</title>
@endif

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/typeahead/typeahead.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/fileinput.min.css') }}">
<!-- END PAGE LEVEL PLUGIN STYLES -->

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
                @if(Request::is('incidencias/nueva*'))
                    Nueva incidencia
                @elseif(Request::is('incidencias/editar*'))
                   incidencia
                @elseif(Request::is('incidencias/ver*'))
                    incidencia
                @endif
			</h3>
			<div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-wrench"></i>
                        <a href="{{ url('incidencias') }}">Incidencias</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
					<li>
                        @if(Request::is('incidencias/nueva*'))
                            <a href="javascript:">Nueva incidencia</a>
                        @elseif(Request::is('incidencias/editar*'))
                            <a href="javascript:">Editar incidencia</a>
                        @elseif(Request::is('incidencias/ver*'))
                            <a href="javascript:">Ver detalles</a>
                        @endif
					</li>
				</ul>
			</div>
			<!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        @if(Request::is('incidencias/nueva*'))
                            <i class="fa fa-plus-circle"></i> Nueva incidencia
                        @elseif(Request::is('incidencias/editar*'))
                            <i class="fa fa-pencil-square-o"></i>incidencia
                        @elseif(Request::is('incidencias/ver*'))
                            <i class="fa fa-folder-open-o"></i> Detalles
                        @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('incidencias/nueva*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/incidencias/nueva') }}" accept-charset="UTF-8">
                @elseif(Request::is('incidencias/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/incidencias/editar') }}" accept-charset="UTF-8">
                @elseif(Request::is('incidencias/ver*'))
                    <form role="form" class="form-horizontal">
                @endif

                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                    @if(Request::is('incidencias/editar*'))
                        <input type="hidden" name="id" value="{{ $incidencia->id }}">
                    @endif

                        <div class="form-body">
                            @if(Request::is('incidencias/editar*') && $incidencia->tipo == 'Mantenimiento programado')
                                <div class="alert alert-warning" role="alert">
                                    <span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
                                    <span class="sr-only">Aviso:</span>
                                    Esta incidencia ha sido generada autom&aacute;ticamente a partir del patrón de
                                    intervenciones asociado a la máquina {{ $maquina->marca }}/{{ $maquina->modelo }}
                                    del cliente {{ $cliente->nombre }}.
                                    Algunos detalles de la incidencia no podrán ser modificados desde este panel.
                                </div>
                            @endif
                            @if(Request::is('incidencias/editar*') && ($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada'))
                                <div class="alert alert-warning" role="alert">
                                    <span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
                                    <span class="sr-only">Aviso:</span>
                                    Esta incidencia est&aacute; programada en el calendiario con fecha {{ date('d/m/Y', strtotime($incidencia->fecha_programada)) }}.
                                    Desprograme la incidencia si desea editar los campos restringidos.
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-2 control-label">Cliente</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <div class="input-group">
                                        <select class="form-control cliente_id" name="cliente_id" required>
                                            <option value="">&nbsp;</option>
                                        @foreach(\App\Cliente::all() as $c)
                                            <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                @elseif(Request::is('incidencias/editar*') && $incidencia->tipo == 'Mantenimiento no programado')
                                        <div class="input-group">
                                            <select class="form-control cliente_id" name="cliente_id" required @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                                <option value="">&nbsp;</option>
                                                @foreach(\App\Cliente::all() as $c)
                                                    <option value="{{ $c->id }}" @if($c->id == $cliente->id) selected="selected" @endif>{{ $c->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                @elseif(Request::is('incidencias/ver*') || $incidencia->tipo == 'Mantenimiento programado')
                                    <p class="form-control-static">
                                        {{ $cliente->nombre }}
                                    </p>
                                @endif
                                </div>
                            </div>
                        @if(Request::is('incidencias/nueva*'))
                        @elseif(Request::is('incidencias/editar*'))
                        @elseif(Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Contacto</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                        {{ $cliente->tlf_contacto }} ({{ $cliente->persona_contacto }})
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if(Request::is('incidencias/nueva*'))
                        @elseif(Request::is('incidencias/editar*'))
                        @elseif(Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Dirección</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                        {{ $cliente->direccion }}
                                    </p>
                                </div>
                            </div>
                        @endif
                            <div class="form-group">
                                <label class="col-md-2 control-label">Máquina</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <select disabled="disabled" class="form-control maquina_id" name="maquina_id" required>
                                        <option value="">&nbsp;</option>
                                    </select>
                                @elseif(Request::is('incidencias/editar*') && $incidencia->tipo == 'Mantenimiento no programado')
                                    <select class="form-control maquina_id" name="maquina_id" @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                        @foreach(\App\Maquina::withTrashed()->where('cliente_id',$cliente->id)->get() as $m)
                                            <option value="{{ $m->id }}" @if($m->id == $maquina->id) selected="selected" @endif>{{ $m->marca }}/{{ $m->modelo }}</option>
                                        @endforeach
                                    </select>
                                @elseif(Request::is('incidencias/ver*') || $incidencia->tipo == 'Mantenimiento programado')
                                    <p class="form-control-static">
                                        {{ $maquina->marca }}/{{ $maquina->modelo }} #{{$maquina->no_serie}}
                                    </p>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tipo de incidencia</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <div class="input-group">
                                        <select class="form-control tipo" name="tipo" required>
                                            <option value="">&nbsp;</option>
                                            <option value="Avería">Avería</option>
                                            <option value="Problema con el secador">Problema con el secador</option>
                                            <option value="Puesta en marcha">Puesta en marcha</option>
                                        </select>
                                    </div>
                                @elseif(Request::is('incidencias/editar*') && $incidencia->tipo != 'Mantenimiento programado')
                                    <div class="input-group">
                                        <select class="form-control tipo" name="tipo" required>
                                            <option value="Avería" @if($incidencia->tipo == 'Avería') selected="selected" @endif>Avería</option>
                                            <option value="Problema con el secador" @if($incidencia->tipo == 'Problema con el secador') selected="selected" @endif>Problema con el secador</option>
                                            <option value="Puesta en marcha" @if($incidencia->tipo == 'Puesta en marcha') selected="selected" @endif>Puesta en marcha</option>
                                        </select>
                                    </div>
                                @elseif($incidencia->tipo == 'Mantenimiento programado')
                                    <p class="form-control-static">
                                        <span class="label label-sm bg-purple">
                                             Mant. {{ $tipo_intervencion->nombre }}
                                            <span data-original-title="{{ $tipo_intervencion->descripcion }}" class="tooltips" data-trigger="hover" data-container="body" data-placement="right"><i class="fa fa-question-circle"></i></span>
                                         </span>
                                    </p>
                                @endif
                                </div>
                            </div>
                            @if((Request::is('incidencias/editar*') && $incidencia->tipo == 'Mantenimiento programado') || Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fecha prevista de programación</label>
                                <div class="col-md-10">
                            @endif
                                @if(Request::is('incidencias/nueva*'))
                                    <input class="form-control date-picker hidden" name="fecha_prevision_programacion" value="{{ date('d/m/Y') }}" type="text" required>
                                @elseif(Request::is('incidencias/editar*'))
                                    <input class="form-control date-picker @if($incidencia->tipo != 'Mantenimiento programado') hidden @endif" name="fecha_prevision_programacion" value="@if($incidencia->fecha_prevision_programacion != '0000-00-00 00:00:00'){{ date('d/m/Y', strtotime($incidencia->fecha_prevision_programacion) ) }}@endif" type="text" required @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                @elseif(Request::is('incidencias/ver*'))
                                    <p class="form-control-static">
                                    @if(!is_null($incidencia->fecha_prevision_programacion) && $incidencia->fecha_prevision_programacion != '0000-00-00 00:00:00')
                                        {{ date('d/m/Y', strtotime($incidencia->fecha_prevision_programacion)) }}
                                    @endif
                                    </p>
                                @endif
                            @if((Request::is('incidencias/editar*') && $incidencia->tipo == 'Mantenimiento programado') || Request::is('incidencias/ver*'))
                                </div>
                            </div>
                            @endif
                        @if(Request::is('incidencias/nueva*'))
                        @elseif(Request::is('incidencias/editar*'))
                        @elseif(Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fecha programada</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                    @if(!is_null($incidencia->fecha_programada) && $incidencia->fecha_programada != '0000-00-00 00:00:00')
                                        {{ date('d/m/Y', strtotime($incidencia->fecha_programada)) }}
                                    @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if(Request::is('incidencias/nueva*'))
                        @elseif(Request::is('incidencias/editar*'))
                        @elseif(Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Estado de incidencia</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                        {{ $incidencia->estado }}
                                    </p>
                                </div>
                            </div>
                        @endif
                            <div class="form-group">
                                <label class="col-md-2 control-label">Urgente</label>
                                <div class="col-md-10">
                                    @if(Request::is('incidencias/nueva*'))
                                        <input id="urgente" name="urgente" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                    @elseif(Request::is('incidencias/editar*'))
                                        <input @if($incidencia->urgente) checked="" @endif id="urgente" name="urgente" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on" @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                    @elseif(Request::is('incidencias/ver*'))
                                        <p class="form-control-static">
                                            @if($incidencia->urgente) Sí @else No @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @if(Request::is('incidencias/nueva*'))
                        @elseif(Request::is('incidencias/editar*'))
                        @elseif(Request::is('incidencias/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tipo de incidencia</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                        {{ $incidencia->tipo }}
                                    </p>
                                </div>
                            </div>
                        @endif
                            <div class="form-group">
                                <label class="col-md-2 control-label">Descripción</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripción de la incidencia"></textarea>
                                @elseif(Request::is('incidencias/editar*'))
                                    <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripción de la incidencia">{{ $incidencia->descripcion }}</textarea>
                                @elseif(Request::is('incidencias/ver*'))
                                    <p class="form-control-static">
                                        {{ $incidencia->descripcion }}
                                    </p>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">#OF</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <div class="input-group">
                                        <input id="no_of" name="no_of" class="form-control" placeholder="Introducir n&ordm; de OF" type="text">
                                    </div>
                                @elseif(Request::is('incidencias/editar*'))
                                    <div class="input-group">
                                        <input id="no_of" name="no_of" class="form-control" placeholder="Introducir n&ordm; de OF" type="text" value="{{ $incidencia->no_of }}" @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                    </div>
                                @elseif(Request::is('incidencias/ver*'))
                                    <p class="form-control-static">
                                        {{ $incidencia->no_of }}
                                    </p>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Check material</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <input id="check_material" name="check_material" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                @elseif(Request::is('incidencias/editar*'))
                                    <input @if($incidencia->check_material) checked="" @endif id="check_material" name="check_material" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on" @if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada') disabled="disabled" @endif>
                                @elseif(Request::is('incidencias/ver*'))
                                    <p class="form-control-static">
                                        @if($incidencia->check_material) Confirmado @else No confirmado @endif
                                    </p>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Contrato</label>
                                <div class="col-md-10">
                                @if(Request::is('incidencias/nueva*'))
                                    <input id="contrato" name="contrato" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                @elseif(Request::is('incidencias/editar*'))
                                    <input @if($incidencia->contrato) checked="" @endif id="contrato" name="contrato" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                @elseif(Request::is('incidencias/ver*'))
                                    <p class="form-control-static">
                                        @if($incidencia->contrato) Sí @else No @endif
                                    </p>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    @if(Request::is('incidencias/nueva*') || Request::is('incidencias/editar*'))
                                        <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                        <a href="{{ URL::previous() }}" class="btn default">Cancelar</a>
                                    @elseif(Request::is('incidencias/ver*'))
                                        <a href="{{ URL::previous() }}" class="btn default">Volver</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                @if(Request::is('incidencias/nueva*'))
                    </form>
                @elseif(Request::is('incidencias/editar*'))
                    </form>
                @elseif(Request::is('incidencias/ver*'))
                    </form>
                @endif
                </div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->

		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

@include('common_footer')

@include('common_js')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/typeahead/handlebars.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/typeahead/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/scripts/metronic.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/layout.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/demo.js"></script>

<script type="text/javascript" src="{{ asset('js/fileinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fileinput_locale_es.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features

    $('.date-picker').datepicker({
        orientation: 'auto',
        todayHighlight: true,
        todayBtn: true,
        language: 'es',
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $('select.cliente_id').on('change', function() {
        var maquinasDropdown = $('select.maquina_id');
        var tokenVal = $('input[name=_token]').val();
        var selectedClienteId = $(this).val();
        if(selectedClienteId === '') {
            maquinasDropdown.empty();
            maquinasDropdown.prop('disabled',true);
        } else {
            maquinasDropdown.prop('disabled',false);
            $.post('/incidencias/fillMaquinasDropdown', {
                _token: tokenVal,
                idCliente: selectedClienteId
            }, function(data) { //handle response
                maquinasDropdown.empty();
                $.each(data, function(index,value){
                    maquinasDropdown.append($("<option />").val(data[index].indice).text(data[index].texto));
                });
            });
        }
    });

    $('select.tipo').on('change', function() {
        if($(this).val() === 'Avería')
            $('input[name="urgente"]').bootstrapSwitch('state', true);
    });
});
</script>

@include('common_end')
