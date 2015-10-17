@include('common_header')

@if(Request::is('clientes/maquinas/piezas/nueva*'))
    <title>Suimaq | {{ $cliente->nombre }} | {{ $maquina->marca }}/{{$maquina->modelo}} | Nueva pieza</title>
@elseif(Request::is('clientes/maquinas/piezas/editar*'))
    <title>Suimaq | {{ $cliente->nombre }} | {{ $maquina->marca }}/{{$maquina->modelo}} |pieza</title>
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
            @if(Request::is('clientes/maquinas/piezas/nueva*'))
                Nueva pieza
            @elseif(Request::is('clientes/maquinas/piezas/editar*'))
               pieza
            @endif
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-users"></i>
						<a href="{{ url('clientes') }}">Clientes</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
                        <a href="{{ url('/clientes/ver?id='.$cliente->id) }}">{{ $cliente->nombre }}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{ url('/clientes/maquinas?id='.$cliente->id) }}"><i class="fa fa-cog"></i> Máquinas</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{ url('/clientes/maquinas/ver?id='.$maquina->id) }}"> {{ $maquina->marca }}/{{ $maquina->modelo }}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
					<li>
                    @if(Request::is('clientes/maquinas/piezas/nueva*'))
                        <a href="javascript:">Nueva pieza</a>
                    @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                        <a href="javascript:">Editar pieza</a>
                        <i class="fa fa-angle-right"></i>
                    @endif
					</li>
                    @if(Request::is('clientes/maquinas/piezas/editar*'))
                    <li>
                        <a href="javascript:">{{ $pieza->nombre }} Ref.:{{ $pieza->referencia }}</a>
                    </li>
                    @endif
				</ul>
			</div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    @if(Request::is('clientes/maquinas/piezas/nueva*'))
                        <i class="fa fa-plus-circle"></i> Nueva pieza
                    @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                        <i class="fa fa-pencil-square-o"></i>pieza
                    @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('clientes/maquinas/piezas/nueva*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/maquinas/piezas/nueva') }}" accept-charset="UTF-8">
                @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/maquinas/piezas/editar') }}" accept-charset="UTF-8">
                @endif
                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                        <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                        <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
                    @if(Request::is('clientes/maquinas/piezas/editar*'))
                        <input type="hidden" name="id" value="{{ $pieza->id }}">
                    @endif
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nombre">Nombre</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/maquinas/piezas/nueva*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre de la pieza" type="text">
                                    </div>
                                @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre de la pieza" type="text" value="{{ $pieza->nombre }}">
                                    </div>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="referencia">Referencia</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/piezas/nueva*'))
                                        <div class="input-group">
                                            <input id="referencia" name="referencia" class="form-control" placeholder="Referencia de la pieza" type="text">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                                        <div class="input-group">
                                            <input id="referencia" name="referencia" class="form-control" placeholder="Referencia de la pieza" type="text" value="{{ $pieza->referencia }}">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="cantidad">Cantidad</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/piezas/nueva*'))
                                        <div class="input-group">
                                            <input id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" type="number" min="0">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                                        <div class="input-group">
                                            <input id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" type="number" min="0" value="{{ $pieza->cantidad }}">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tipo_intervenciones_id">Tipo de intervención</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/piezas/nueva*'))
                                        <div class="input-group">
                                            <select class="form-control tipo_intervenciones_id" name="tipo_intervenciones_id" required>
                                                <option value="">&nbsp;</option>
                                                @foreach(\App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->orderBy('posicion','ASC')->get() as $step)
                                                    <option value="{{ $step->tipo_intervenciones_id }}">{{ \App\TipoIntervencion::withTrashed()->where('id',$step->tipo_intervenciones_id)->pluck('nombre') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                                        <div class="input-group">
                                            <select class="form-control tipo_intervenciones_id" name="tipo_intervenciones_id" required>
                                                @foreach(\App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->orderBy('posicion','ASC')->get() as $step)
                                                    <option value="{{ $step->tipo_intervenciones_id }}" @if($step->tipo_intervenciones_id == $pieza->tipo_intervenciones_id) selected="selected" @endif>{{ \App\TipoIntervencion::withTrashed()->where('id',$step->tipo_intervenciones_id)->pluck('nombre') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{ url('/clientes/maquinas/piezas?id='.$maquina->id) }}" class="btn default">Cancelar</a>
                                </div>
                            </div>
                        </div>

                @if(Request::is('clientes/maquinas/piezas/nueva*'))
                    </form>
                @elseif(Request::is('clientes/maquinas/piezas/editar*'))
                    </form>
                @endif
                </div>
            </div>

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
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
    });
</script>

@include('common_end')
