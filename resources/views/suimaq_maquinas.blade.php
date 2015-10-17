@include('common_header')

<title>Suimaq | {{ $cliente->nombre }} | Máquinas</title>

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
			<h3 class="page-title">Máquinas <small>{{ $cliente->nombre }}</small></h3>
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
                    </li>
				</ul>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="{{ url('clientes/maquinas/nueva?cliente='.$cliente->id) }}" class="btn green">
								    <i class="fa fa-plus"></i> Nueva máquina
								</a>
							</div>
						</div>
                        <div class="col-md-6 text-right" id="paginationLinks1">
                            {!! $maquinas->appends(Request::except('page'))->render() !!}
                        </div>
					</div>
				</div>
                <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                <input type="hidden" name="idCliente" value="{{ $cliente->id }}">
				<div class="table-scrollable">
					<table id="tablaMaquinas" class="table table-striped table-hover table-bordered dataTable no-footer">
						<thead>
							<tr class="heading">
                                <th>#</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de serie</th>
                                <th>Horas</th>
                                <th>Rev.</th>
                                <th>Patrón int.</th>
                                <th>Piezas</th>
                                <th>Localización</th>
                                <th></th>
							</tr>
                            <tr class="filter">
                                <td></td>
                                <td>
                                    <input type="search" name="marca" class="form-control form-filter input-sm" placeholder="Filtrar por marca" aria-controls="sample_1">
                                </td>
                                <td>
                                    <input type="search" name="modelo" class="form-control form-filter input-sm" placeholder="Filtrar por modelo" aria-controls="sample_1">
                                </td>
                                <td>
                                    <input type="search" name="no_serie" class="form-control form-filter input-sm" placeholder="Filtrar por n&ordm; de serie" aria-controls="sample_1">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
						</thead>
						<tbody id="tbodyMaquinas">
                            @foreach($maquinas as $m)
							<tr>
                                <input class="id" type="hidden" value="{{ $m->id }}">
								<td align="center">{{ $m->id }}</td>
								<td>{{ $m->marca }}</td>
								<td>{{ $m->modelo }} | <a href="{{ asset('docs/'.$m->doc) }}"><small><i class="fa fa-download"></i> Manual</small></a></td>
								<td>{{ $m->no_serie }}</td>
								<td>{{ $m->horas_funcionamiento }}</td>
								<td>{{ $m->no_revisiones_anuales }}</td>
                                <td>
                                @if(count($m->secuencia))
                                    @foreach($m->secuencia as $step){{ $step->tipointervencion()->withTrashed()->pluck('nombre') }}@endforeach
                                @endif
                                </td>
                                <td>
                                    <a href="{{ url('/clientes/maquinas/piezas?id='.$m->id) }}">{{ $m->piezas()->count() }} piezas</a>
                                </td>
                                <td>{{ $m->cliente()->pluck('direccion') }} | <a target="_blank" href="https://www.google.com/maps/dir/Current+Location/<?php foreach(preg_split('/[ \r\n]/',$m->cliente()->pluck('direccion')) as $piece) { echo $piece.'+'; } ?>"><small><i class="fa fa-map-marker"></i> Cómo llegar</small></a></td>
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
                            Mostrando <span id="de">{{ $maquinas->firstItem() }}</span> a <span id="a">{{ $maquinas->lastItem() }}</span> de <span id="total">{{ $maquinas->total() }}</span> máquinas
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class=" pull-right dataTables_paginate paging_simple_numbers" id="paginationLinks2">
                            {!! $maquinas->appends(Request::except('page'))->render() !!}
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

    var multSearch = (function(){
        var marcaTB = $('input[name=marca]');
        var modeloTB = $('input[name=modelo]');
        var noSerieTB = $('input[name=no_serie]');
        var tokenVal = $('input[name=_token]').val();
        var idCliente = $('input[name=idCliente]').val();
        var strMarca = marcaTB.val();
        var strModelo = modeloTB.val();
        var strNoSerie = noSerieTB.val();
        $.post('/clientes/maquinas/buscar', {
            _token: tokenVal,
            idCliente: idCliente,
            strMarca: strMarca,
            strModelo: strModelo,
            strNoSerie: strNoSerie
        }, function(data) { //handle response
            //replace pagination links 1
            $('#paginationLinks1').replaceWith($(data).find('#paginationLinks1'));
            //replace pagination links 2
            $('#paginationLinks2').replaceWith($(data).find('#paginationLinks2'));
            //replace pagination info
            $('#paginationInfo').replaceWith($(data).find('#paginationInfo'));
            //replace table content
            $('#tbodyMaquinas').empty().append($(data).find('#tbodyMaquinas').html());
            //hide search feedback (***)
            marcaTB.removeClass('spinner');
            modeloTB.removeClass('spinner');
            noSerieTB.removeClass('spinner');
            //reinitialize confirmation popovers
            $('[data-toggle="confirmation"]').confirmation();
        });
        return false;
    });

    $('input[name=marca]').keyup(function() {
        var searchTB = $('input[name=marca]');
        delay(function(){
            searchTB.addClass('spinner');
            multSearch();
        }, 500 );
    });
    $('input[name=modelo]').keyup(function() {
        var searchTB = $('input[name=modelo]');
        delay(function(){
            searchTB.addClass('spinner');
            multSearch();
        }, 500 );
    });
    $('input[name=no_serie]').keyup(function() {
        var searchTB = $('input[name=no_serie]');
        delay(function(){
            searchTB.addClass('spinner');
            multSearch();
        }, 500 );
    });

    var tableBody = $("#tbodyMaquinas");
    tableBody.on('click', '.btn-historial', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/maquinas/historial?' + $.param({ id: id });
    });
    tableBody.on('click', '.btn-ver', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/maquinas/ver?' + $.param({ id: id }); //TODO
    });
    tableBody.on('click', '.btn-editar', function() {
        var linkTag = $(this);
        var id = linkTag.closest('tr').find('.id').val();
        window.location.href = '/clientes/maquinas/editar?' + $.param({ id: id }); //TODO
    });
    tableBody.on('confirmed.bs.confirmation','.btn-eliminar',function() {
        var linkTag = $(this);
        var tokenVal = $('input[name=_token]').val();
        var id = linkTag.closest('tr').find('.id').val();
        $.post('/clientes/maquinas/eliminar', { //TODO
            _token: tokenVal,
            id: id
        }, function(data) {
            console.log(data);
            if(data[1]===true) {
                //delete row
                linkTag.closest('tr').fadeOut();
                //update table row counters
                minusOne($('#a'));
                minusOne($('#total'));
                //show success toastr
                toastr['success']('Máquina eliminada con éxito.','Eliminar máquina',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            } else {
                //show error toastr
                toastr['error']('La máquina no existe o no pudo ser eliminada. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.','Eliminar máquina',{
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });
    });
    tableBody.on('canceled.bs.confirmation','.btn-eliminar',function() {
        console.log('Cancelada acción de eliminar máquina');
    });

    var minusOne = (function(obj) {
        var objVal = parseInt(obj.text());
        obj.text(objVal-1);
        return false;
    });

});
</script>

@include('common_end')
