@include('common_header')

<title>Suimaq | Clientes</title>

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
			Clientes
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-users"></i>
                        <a href="{{ url('clientes') }}">Clientes</a>
					</li>
				</ul>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="{{ url('clientes/nuevo') }}" class="btn green">
								    <i class="fa fa-plus"></i> Nuevo cliente
								</a>
							</div>
						</div>
                        <div class="col-md-6 text-right" id="paginationLinks1">
                            {!! $clientes->appends(Request::except('page'))->render() !!}
                        </div>
					</div>
				</div>
                <input type="hidden" name="_token" value="{{ Session::getToken() }}">
				<div class="table-scrollable">
					<table id="tablaClientes" class="table table-striped table-hover table-bordered dataTable no-footer">
						<thead>
							<tr class="heading">
								<th>VIP</th>
								<th>Nombre</th>
								<th>Persona de contacto</th>
								<th>Teléfono</th>
								<th>Dirección</th>
								<th>Maquinaria</th>
								<th></th>
							</tr>
                            <tr class="filter">
                                <td></td>
                                <td>
                                    <input type="search" name="company" class="form-control form-filter input-sm" placeholder="Ej: Bosch, Samsung..." aria-controls="sample_1">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
						</thead>
						<tbody id="tbodyClientes">
                            @foreach($clientes as $c)
							<tr>
                                <input class="id" type="hidden" value="{{ $c->id }}">
								<td align="center">
                                    @if($c->vip)
                                        <i class="fa fa-star"></i>
                                    @endif
                                </td>
								<td>{{ $c->nombre }}</td>
								<td>{{ $c->persona_contacto }}</td>
								<td>{{ $c->tlf_contacto }}</td>
								<td>{{ $c->direccion }}</td>
								<td>
                                    <a href="javascript:" class="btn-maquinas">{{ $c->no_maquinas }} máquinas</a> <a href="{{ url('clientes/maquinas/nueva?cliente='.$c->id) }}"><i class="fa fa-plus-square" style="color:#35AA47;"></i></a>
                                </td>
								<td>
								    <a href="javascript:" class="btn-historial btn default btn-xs purple-stripe"><i class="fa fa-history"></i></a>
                                    <a href="javascript:" class="btn-ver btn default btn-xs blue-stripe"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:" class="btn-editar btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:" class="btn-eliminar btn default btn-xs red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="dataTables_info" id="paginationInfo" role="status" aria-live="polite">
                            Mostrando <span id="de">{{ $clientes->firstItem() }}</span> a <span id="a">{{ $clientes->lastItem() }}</span> de <span id="total">{{ $clientes->total() }}</span> clientes
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class=" pull-right dataTables_paginate paging_simple_numbers" id="paginationLinks2">
                            {!! $clientes->appends(Request::except('page'))->render() !!}
                        </div>
                    </div>
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

    //custom javascripts for this page
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $('input[name=company]').keyup(function() {
        var tokenVal = $('input[name=_token]').val();
        var searchTB = $('input[name=company]');
        var strCompany = this.value;
        delay(function(){
            //show search feedback (***)
            searchTB.addClass('spinner');
            $.post('/clientes/buscar', {
                _token: tokenVal,
                searchStr: strCompany
            }, function(data) { //handle response
                //replace pagination links 1
                $('#paginationLinks1').replaceWith($(data).find('#paginationLinks1'));
                //replace pagination links 2
                $('#paginationLinks2').replaceWith($(data).find('#paginationLinks2'));
                //replace pagination info
                $('#paginationInfo').replaceWith($(data).find('#paginationInfo'));
                //replace table content
                $('#tbodyClientes').empty().append($(data).find('#tbodyClientes').html());
                //hide search feedback (***)
                searchTB.removeClass('spinner');
                //reinitialize confirmation popovers
                $('[data-toggle="confirmation"]').confirmation();
            });
        }, 500 );
    });

    var tableBody = $("#tbodyClientes");
    tableBody.on('click', '.btn-historial', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/historial?' + $.param({ id: id });
    });
    tableBody.on('click', '.btn-ver', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/ver?' + $.param({ id: id });
    });
    tableBody.on('click', '.btn-editar', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/editar?' + $.param({ id: id });
    });
    tableBody.on('click','.btn-maquinas', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/maquinas?' + $.param({ id: id });
    });
    tableBody.on('confirmed.bs.confirmation','.btn-eliminar',function() {
        var linkTag = $(this);
        var tokenVal = $('input[name=_token]').val();
        var id = linkTag.closest('tr').find('.id').val();
        $.post('/clientes/eliminar', {
            _token: tokenVal,
            id: id
        }, function(data) {
            console.log(data);
            if(data[2]===true) {
                //delete row
                linkTag.closest('tr').fadeOut();
                //update table row counters
                minusOne($('#a'));
                minusOne($('#total'));
                //show success toastr
                toastr['success']('Cliente eliminado con éxito.','Eliminar cliente',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            } else {
                //show error toastr
                toastr['error']('El cliente no existe o no pudo ser eliminado. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.','Eliminar cliente',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });
    });
    tableBody.on('canceled.bs.confirmation','.btn-eliminar',function() {
        console.log('Cancelada acción de eliminar cliente');
    });

    var minusOne = (function(obj) {
        var objVal = parseInt(obj.text());
        obj.text(objVal-1);
        return false;
    });

});
</script>
@include('common_end')
