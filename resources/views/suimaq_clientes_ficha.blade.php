@include('common_header')

@if(Request::is('clientes/nuevo'))
    <title>Suimaq | Nuevo cliente</title>
@elseif(Request::is('clientes/editar*'))
    <title>Suimaq |cliente  | {{ $cliente->nombre }}</title>
@elseif(Request::is('clientes/ver*'))
    <title>Suimaq | {{ $cliente->nombre }}</title>
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
            @if(Request::is('clientes/nuevo'))
                Nuevo cliente
            @elseif(Request::is('clientes/editar*'))
               cliente
            @elseif(Request::is('clientes/ver*'))
                {{ $cliente->nombre }}
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
                    @if(Request::is('clientes/nuevo'))
                        <a href="javascript:">Nuevo</a>
                    @elseif(Request::is('clientes/editar*'))
                        <a href="javascript:">Editar</a>
                        <i class="fa fa-angle-right"></i>
                    @elseif(Request::is('clientes/ver*'))
                        <a href="javascript:">{{ $cliente->nombre }}</a>
                    @endif
					</li>
                    @if(Request::is('clientes/editar*'))
                    <li>
                        <a href="javascript:">{{ $cliente->nombre }}</a>
                    </li>
                    @endif
				</ul>
			</div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    @if(Request::is('clientes/nuevo'))
                        <i class="fa fa-user-plus"></i> Nuevo
                    @elseif(Request::is('clientes/editar*'))
                        <i class="fa fa-pencil-square-o"></i> Editar
                    @elseif(Request::is('clientes/ver*'))
                        <i class="fa fa-folder-open-o"></i> Datos del cliente
                    @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('clientes/nuevo'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/nuevo') }}" accept-charset="UTF-8">
                @elseif(Request::is('clientes/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/editar') }}" accept-charset="UTF-8">
                @elseif(Request::is('clientes/ver*'))
                    <form role="form" class="form-horizontal">
                @endif
                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                    @if(Request::is('clientes/editar*'))
                        <input type="hidden" name="id" value="{{ $cliente->id }}">
                    @endif
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nombre">Nombre</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/nuevo'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del cliente" type="text">
                                    </div>
                                @elseif(Request::is('clientes/editar*'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del cliente" type="text" value="{{ $cliente->nombre }}">
                                    </div>
                                @elseif(Request::is('clientes/ver*'))
                                    <p class="form-control-static">
                                        {{ $cliente->nombre }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="vip">VIP</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/nuevo'))
                                    <input id="vip" name="vip" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                @elseif(Request::is('clientes/editar*'))
                                    <input @if($cliente->vip) checked="" @endif id="vip" name="vip" class="make-switch" data-on-text="Sí" data-off-text="No" type="checkbox" value="on">
                                @elseif(Request::is('clientes/ver*'))
                                    <p class="form-control-static">
                                        @if($cliente->vip) Sí @else No @endif
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="persona_contacto">Persona de contacto</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/nuevo'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" placeholder="Nombre y apellidos de la persona de contacto" type="text" name="persona_contacto" id="persona_contacto">
                                    </div>
                                @elseif(Request::is('clientes/editar*'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" placeholder="Nombre y apellidos de la persona de contacto" type="text" name="persona_contacto" id="persona_contacto" value="{{ $cliente->persona_contacto }}">
                                    </div>
                                @elseif(Request::is('clientes/ver*'))
                                        <p class="form-control-static">
                                            {{ $cliente->persona_contacto }}
                                        </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tlf_contacto">Teléfono de contacto</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/nuevo'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control" placeholder="Teléfono de contacto" type="text" name="tlf_contacto" id="tlf_contacto">
                                    </div>
                                @elseif(Request::is('clientes/editar*'))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control" placeholder="Teléfono de contacto" type="text" name="tlf_contacto" id="tlf_contacto" value="{{ $cliente->tlf_contacto }}">
                                    </div>
                                @elseif(Request::is('clientes/ver*'))
                                        <p class="form-control-static">
                                            {{ $cliente->tlf_contacto }}
                                        </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="direccion">Dirección</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/nuevo'))
                                    <textarea class="form-control" rows="3" id="direccion" name="direccion" placeholder="Dirección del cliente"></textarea>
                                @elseif(Request::is('clientes/editar*'))
                                    <textarea class="form-control" rows="3" id="direccion" name="direccion" placeholder="Dirección del cliente">{{ $cliente->direccion }}</textarea>
                                @elseif(Request::is('clientes/ver*'))
                                    <p class="form-control-static">
                                        {{ $cliente->direccion }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="observaciones">Observaciones</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/nuevo'))
                                        <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder="Observaciones sobre el cliente"></textarea>
                                    @elseif(Request::is('clientes/editar*'))
                                        <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder="Observaciones sobre el cliente">{{ $cliente->observaciones }}</textarea>
                                    @elseif(Request::is('clientes/ver*'))
                                        <p class="form-control-static">
                                            {{ $cliente->observaciones }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">E-mail</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<input class="form-control" placeholder="E-mail de contacto" type="email">--}}
                                        {{--<span class="input-group-addon"><i class="fa fa-envelope"></i></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Right Icon</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="input-icon right">--}}
                                        {{--<i class="fa fa-microphone"></i>--}}
                                        {{--<input class="form-control" placeholder="Right icon" type="text">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Icon Input in Group Input</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<div class="input-icon">--}}
                                            {{--<i class="fa fa-lock fa-fw"></i>--}}
                                            {{--<input id="newpassword" class="form-control" name="password" placeholder="password" type="text">--}}
                                        {{--</div>--}}
                                        {{--<span class="input-group-btn">--}}
                                        {{--<button id="genpassword" class="btn btn-success" type="button"><i class="fa fa-arrow-left fa-fw"></i> Random</button>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Input With Spinner</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input class="form-control spinner" placeholder="Password" type="password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Static Control</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<p class="form-control-static">--}}
                                        {{--email@example.com--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Disabled</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input class="form-control" placeholder="Disabled" disabled="" type="password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Readonly</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input class="form-control" placeholder="Readonly" readonly="" type="password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Dropdown</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<select class="form-control">--}}
                                        {{--<option>Option 1</option>--}}
                                        {{--<option>Option 2</option>--}}
                                        {{--<option>Option 3</option>--}}
                                        {{--<option>Option 4</option>--}}
                                        {{--<option>Option 5</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Multiple Select</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<select multiple="" class="form-control">--}}
                                        {{--<option>Option 1</option>--}}
                                        {{--<option>Option 2</option>--}}
                                        {{--<option>Option 3</option>--}}
                                        {{--<option>Option 4</option>--}}
                                        {{--<option>Option 5</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Textarea</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<textarea class="form-control" rows="3"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputFile" class="col-md-2 control-label">File input</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input id="exampleInputFile" type="file">--}}
                                    {{--<p class="help-block">--}}
                                        {{--some help text here.--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Checkboxes</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="checkbox-list">--}}
                                        {{--<label>--}}
                                            {{--<div class="checker"><span><input type="checkbox"></span></div> Checkbox 1 </label>--}}
                                        {{--<label>--}}
                                            {{--<div class="checker"><span><input type="checkbox"></span></div> Checkbox 1 </label>--}}
                                        {{--<label>--}}
                                            {{--<div class="checker disabled"><span><input disabled="" type="checkbox"></span></div> Disabled </label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Inline Checkboxes</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="checkbox-list">--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<div id="uniform-inlineCheckbox21" class="checker"><span><input id="inlineCheckbox21" value="option1" type="checkbox"></span></div> Checkbox 1 </label>--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<div id="uniform-inlineCheckbox22" class="checker"><span><input id="inlineCheckbox22" value="option2" type="checkbox"></span></div> Checkbox 2 </label>--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<div id="uniform-inlineCheckbox23" class="checker disabled"><span><input id="inlineCheckbox23" value="option3" disabled="" type="checkbox"></span></div> Disabled </label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Radio</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="radio-list">--}}
                                        {{--<label>--}}
                                            {{--<div id="uniform-optionsRadios22" class="radio"><span><input name="optionsRadios" id="optionsRadios22" value="option1" checked="" type="radio"></span></div> Option 1 </label>--}}
                                        {{--<label>--}}
                                            {{--<div id="uniform-optionsRadios23" class="radio"><span><input name="optionsRadios" id="optionsRadios23" value="option2" checked="" type="radio"></span></div> Option 2 </label>--}}
                                        {{--<label>--}}
                                            {{--<div id="uniform-optionsRadios24" class="radio disabled"><span><input name="optionsRadios" id="optionsRadios24" value="option2" disabled="" type="radio"></span></div> Disabled </label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label">Inline Radio</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<div class="radio-list">--}}
                                        {{--<label class="radio-inline">--}}
                                            {{--<div id="uniform-optionsRadios25" class="radio"><span><input name="optionsRadios" id="optionsRadios25" value="option1" checked="" type="radio"></span></div> Option 1 </label>--}}
                                        {{--<label class="radio-inline">--}}
                                            {{--<div id="uniform-optionsRadios26" class="radio"><span class="checked"><input name="optionsRadios" id="optionsRadios26" value="option2" checked="" type="radio"></span></div> Option 2 </label>--}}
                                        {{--<label class="radio-inline">--}}
                                            {{--<div id="uniform-optionsRadios27" class="radio disabled"><span><input name="optionsRadios" id="optionsRadios27" value="option3" disabled="" type="radio"></span></div> Disabled </label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            
                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                @if(Request::is('clientes/nuevo') || Request::is('clientes/editar*'))
                                    <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{ url('clientes') }}" class="btn default">Cancelar</a>
                                @elseif(Request::is('clientes/ver*'))
                                    <a href="{{ URL::previous() }}" class="btn default">Volver</a>
                                @endif
                                </div>
                            </div>
                        </div>

                @if(Request::is('clientes/nuevo'))
                    </form>
                @elseif(Request::is('clientes/editar*'))
                    </form>
                @elseif(Request::is('clientes/ver*'))
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
<script src="{{ asset('') }}assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
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
