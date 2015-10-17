@include('common_header')

@if(Request::is('intervenciones/tipos/nuevo*'))
    <title>Suimaq | Nuevo tipo de intervención</title>
@elseif(Request::is('intervenciones/tipos/editar*'))
    <title>Suimaq |tipo de intervención</title>
@elseif(Request::is('intervenciones/tipos/ver*'))
    <title>Suimaq | tipo de intervención</title>
@endif

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/typeahead/typeahead.css">
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
            @if(Request::is('intervenciones/tipos/nuevo*'))
                Nuevo tipo de intervención
            @elseif(Request::is('intervenciones/tipos/editar*'))
               tipo de intervención
            @elseif(Request::is('intervenciones/tipos/ver*'))
                tipo de intervención
            @endif
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-cogs"></i>
						<a href="{{ url('intervenciones') }}">Intervenciones</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
                    @if(Request::is('intervenciones/tipos/nuevo*'))
                        <a href="javascript:">Nuevo tipo de intervención</a>
                    @elseif(Request::is('intervenciones/tipos/editar*'))
                        <a href="javascript:">Editar tipo de intervención</a>
                        <i class="fa fa-angle-right"></i>
                    @elseif(Request::is('intervenciones/tipos/ver*'))
                        <a href="javascript:">{{ $tipo->nombre }}</a>
                    @endif
					</li>
                    @if(Request::is('intervenciones/tipos/editar*'))
                    <li>
                        <a href="javascript:">{{ $tipo->nombre }}</a>
                    </li>
                    @endif
				</ul>
			</div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    @if(Request::is('intervenciones/tipos/nuevo*'))
                        <i class="fa fa-plus-circle"></i> Nuevo tipo de intervención
                    @elseif(Request::is('intervenciones/tipos/editar*'))
                        <i class="fa fa-pencil-square-o"></i>tipo de intervención
                    @elseif(Request::is('intervenciones/tipos/ver*'))
                        <i class="fa fa-folder-open-o"></i> Detalles
                    @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('intervenciones/tipos/nuevo*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{{ URL::to('/intervenciones/tipos/nuevo') }}}" accept-charset="UTF-8">
                @elseif(Request::is('intervenciones/tipos/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{{ URL::to('/intervenciones/tipos/editar') }}}" accept-charset="UTF-8">
                @elseif(Request::is('intervenciones/tipos/ver*'))
                    <form role="form" class="form-horizontal">
                @endif
                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                    @if(Request::is('intervenciones/tipos/editar*'))
                        <input type="hidden" name="id" value="{{ $tipo->id }}">
                    @endif
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nombre">Nombre</label>
                                <div class="col-md-10">
                                @if(Request::is('intervenciones/tipos/nuevo*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del tipo de intervención" type="text">
                                    </div>
                                @elseif(Request::is('intervenciones/tipos/editar*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del tipo de intervención" type="text" value="{{ $tipo->nombre }}">
                                    </div>
                                @elseif(Request::is('intervenciones/tipos/ver*'))
                                    <p class="form-control-static">
                                        {{ $tipo->nombre }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="descripcion">Descripción</label>
                                <div class="col-md-10">
                                    @if(Request::is('intervenciones/tipos/nuevo*'))
                                        <div class="input-group">
                                            <input id="descripcion" name="descripcion" class="form-control" placeholder="Descripción del tipo de intervención" type="text">
                                        </div>
                                    @elseif(Request::is('intervenciones/tipos/editar*'))
                                        <div class="input-group">
                                            <input id="descripcion" name="descripcion" class="form-control" placeholder="Descripción del tipo de intervención" type="text" value="{{ $tipo->descripcion }}">
                                        </div>
                                    @elseif(Request::is('intervenciones/tipos/ver*'))
                                        <p class="form-control-static">
                                            {{ $tipo->descripcion }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                @if(Request::is('intervenciones/tipos/nuevo*') || Request::is('intervenciones/tipos/editar*'))
                                    <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{ url('/intervenciones') }}" class="btn default">Cancelar</a>
                                @elseif(Request::is('intervenciones/tipos/ver*'))
                                    <a href="{{ URL::previous() }}" class="btn default">Volver</a>
                                @endif
                                </div>
                            </div>
                        </div>

                @if(Request::is('intervenciones/tipos/nuevo*'))
                    </form>
                @elseif(Request::is('intervenciones/tipos/editar*'))
                    </form>
                @elseif(Request::is('intervenciones/tipos/ver*'))
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
