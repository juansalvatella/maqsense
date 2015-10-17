@include('common_header')

<title>Suimaq | Intervenciones</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" type="text/css" rel="stylesheet"/>
<link href="{{ asset('') }}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" type="text/css" rel="stylesheet"/>
<link href="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.css" type="text/css" rel="stylesheet"/>
<link href="{{ asset('') }}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" type="text/css" rel="stylesheet"/>
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
			Intervenciones
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-cogs"></i> <a href="javascript:">Intervenciones</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<div class="row ">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-madison">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-tasks"></i>Patrones de intervenciones
							</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{{ url('intervenciones/patrones/nuevo') }}" class="btn green">
                                                <i class="fa fa-plus"></i> Nuevo patrón
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                            <div class="table-scrollable">
                                <table class="table table-striped table-hover table-bordered dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Secuencia</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPatrones">
                                    @foreach($patrones as $patron)
                                        <tr>
                                            <input class="id" type="hidden" value="{{ $patron->id }}">
                                            <td>{{ $patron->nombre }} @if(count($patron->steps))&#40;@foreach($patron->steps as $step){{ $step->tipointervencion()->withTrashed()->pluck('nombre') }}@endforeach&#41;@endif</td>
                                            <td>
                                                @foreach($patron->steps as $step)
                                                    {{ $step->tipointervencion()->withTrashed()->pluck('nombre') }} <i class="fa fa-caret-right"></i>
                                                @endforeach
                                                @if(count($patron->steps))
                                                    {{ $patron->steps()->first()->tipointervencion()->withTrashed()->pluck('nombre') }}...
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:" class="btn-editar btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:" class="btn-eliminar btn default btn-xs red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
					<!-- END PORTLET-->
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-madison">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-list"></i>Tipos de intervenciones
							</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{{ url('intervenciones/tipos/nuevo') }}" class="btn green">
                                                <i class="fa fa-plus"></i> Nuevo tipo de intervención
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable">
                                <table class="table table-striped table-hover table-bordered dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyTiposDeIntervenciones">
                                        @foreach($tipos_de_intervencion as $tipo)
                                        <tr>
                                            <input class="id" type="hidden" value="{{ $tipo->id }}">
                                            <td>{{ $tipo->nombre }}</td>
                                            <td>{{ $tipo->descripcion }}</td>
                                            <td>
                                                <a href="javascript:" class="btn-editar btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:" class="btn-eliminar btn default btn-xs red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

@include('common_footer')

@include('common_js')

<!-- BEGIN PAGE LEVEL PLUGINS & SCRIPTS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/fuelux/js/spinner.min.js" ></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" ></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" ></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" ></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/ckeditor/ckeditor.js" ></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>

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

    var tbodyPatrones = $("#tbodyPatrones");
    var tbodyTipos = $("#tbodyTiposDeIntervenciones");
    tbodyPatrones.on('click', '.btn-editar', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/intervenciones/patrones/editar?' + $.param({ id: id });
    });
    tbodyTipos.on('click', '.btn-editar', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/intervenciones/tipos/editar?' + $.param({ id: id });
    });
    tbodyPatrones.on('confirmed.bs.confirmation','.btn-eliminar',function() {
        var linkTag = $(this);
        var tokenVal = $('input[name=_token]').val();
        var id = linkTag.closest('tr').find('.id').val();
        $.post('/intervenciones/patrones/eliminar', {
            _token: tokenVal,
            id: id
        }, function(data) {
            console.log(data);
            if(data[0]===true) {
                //delete row
                linkTag.closest('tr').fadeOut();
                //show success toastr
                toastr['success']('Patrón de intervenciones eliminado con éxito.','Eliminar patrón de intervenciones',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            } else {
                //show error toastr
                toastr['error']('El patrón de intervenciones no existe o no pudo ser eliminado. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.','Eliminar patrón de intervenciones',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });
    });
    tbodyPatrones.on('canceled.bs.confirmation','.btn-eliminar',function() {
        console.log('Cancelada acción de eliminar patrón de intervenciones.');
    });
    tbodyTipos.on('confirmed.bs.confirmation','.btn-eliminar',function() {
        var linkTag = $(this);
        var tokenVal = $('input[name=_token]').val();
        var id = linkTag.closest('tr').find('.id').val();
        $.post('/intervenciones/tipos/eliminar', {
            _token: tokenVal,
            id: id
        }, function(data) {
            console.log(data);
            if(data[0]===true) {
                //delete row
                linkTag.closest('tr').fadeOut();
                //show success toastr
                toastr['success']('Tipo de intervención eliminada con éxito.','Eliminar tipo de intervención',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            } else {
                //show error toastr
                toastr['error']('El tipo de intervención no existe o no pudo ser eliminado. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.','Eliminar tipo de intervención',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });
    });
    tbodyTipos.on('canceled.bs.confirmation','.btn-eliminar',function() {
        console.log('Cancelada acción de eliminar tipo de intervención.');
    });

});
</script>

@include('common_end')
