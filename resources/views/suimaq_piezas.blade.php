@include('common_header')

<title>Suimaq | {{ $cliente->nombre }} | {{ $maquina->marca }}/{{$maquina->modelo}} | Piezas</title>

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
			<h3 class="page-title">Piezas <small>{{ $maquina->marca }}/{{ $maquina->modelo }}</small></h3>
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
                        <a href="javascript:">Piezas</a>
                    </li>
				</ul>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="{{ url('clientes/maquinas/piezas/nueva?maquina='.$maquina->id) }}" class="btn green">
								    <i class="fa fa-plus"></i> A&ntilde;adir pieza
								</a>
							</div>
						</div>
					</div>
				</div>
                <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                <input type="hidden" name="idCliente" value="{{ $cliente->id }}">
                <input type="hidden" name="idMaquina" value="{{ $maquina->id }}">
				<div class="table-scrollable">
					<table id="tablaMaquinas" class="table table-striped table-hover table-bordered dataTable no-footer">
						<thead>
							<tr class="heading">
                                <th>Nombre</th>
                                <th>Referencia</th>
                                <th>Cantidad</th>
                                <th>Tipo de intervención</th>
                                <th></th>
							</tr>
						</thead>
						<tbody id="tbodyPiezas">
                        @foreach($piezas as $pieza)
							<tr>
                                <input class="id" type="hidden" value="{{ $pieza->id }}">
								<td>{{ $pieza->nombre }}</td>
								<td>{{ $pieza->referencia }}</td>
								<td>{{ $pieza->cantidad }}</td>
                                <td>{{ $pieza->tipo_intervencion()->withTrashed()->pluck('nombre') }}</td>
                                <td>
								    <a href="{{ url('/clientes/maquinas/piezas/editar?id='.$pieza->id) }}" class="btn-editar btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:" class="btn-eliminar btn default btn-xs red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
								</td>
							</tr>
                        @endforeach
						</tbody>
					</table>
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

<script type="text/javascript" src="{{ asset('') }}assets/global/scripts/metronic.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/layout.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/demo.js"></script>
<!-- END PAGE LEVEL PLUGINS & SCRIPTS -->
<script>
jQuery(document).ready(function() {
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features

    var tableBody = $("#tbodyPiezas");
    tableBody.on('confirmed.bs.confirmation','.btn-eliminar',function() {
        var linkTag = $(this);
        var tokenVal = $('input[name=_token]').val();
        var id = linkTag.closest('tr').find('.id').val();
        $.post('/clientes/maquinas/piezas/eliminar', { //TODO
            _token: tokenVal,
            id: id
        }, function(data) {
            console.log(data);
            if(data[0]===true) {
                //delete row
                linkTag.closest('tr').fadeOut();
                //show success toastr
                toastr['success']('Pieza eliminada con éxito.','Eliminar pieza',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            } else {
                //show error toastr
                toastr['error']('La pieza no existe o no pudo ser eliminada. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.','Eliminar pieza',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });
    });
    tableBody.on('canceled.bs.confirmation','.btn-eliminar',function() {
        console.log('Cancelada acción de eliminar pieza');
    });

});
</script>

@include('common_end')
