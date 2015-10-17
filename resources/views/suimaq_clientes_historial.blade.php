@include('common_header')

<title>Suimaq | Clientes historial</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css">
<link href="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="{{ asset('') }}assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
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
            <h3 class="page-title">Historial de incidencias <small>{{ $cliente->nombre }}</small></h3>
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
                        <a href="javascript:"><i class="fa fa-history"></i> Historial</a>
                    </li>
                </ul>
            </div>
			<div class="portlet">
				<div class="portlet-body">
					<div class="row">
						<form action="#" class="form-horizontal form-bordered">
								<div class="form-body">
									<div>
										<label class="control-label col-md-2">Seleccionar intervalo</label>
										<div class="col-md-4">
											<div class="input-group" id="defaultrange">
												<input type="text" class="form-control">
												<span class="input-group-btn">
												    <button class="btn default date-range-toggle" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
												</span>
											</div>
										</div>
										<div class="col-md-6 left">
											<a href="javascript:" class="btn green"><i class="fa fa-check"></i> Aplicar</a>
										</div>
									</div>
								</div>
							</form>
					</div>
                    <div style="margin: 20px 0 5px 0;">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:" class="btn blue">
                                    <i class="fa fa-print"></i> Imprimir
                                </a>
                            </div>
                            <div class="col-md-6 text-right" id="paginationLinks1">
                                {!! $incidencias->appends(Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
						<tr>
							<th>#</th>
                            <th>Fecha programada</th>
                            <th>Fecha prevista</th>
							<th>Cliente</th>
							<th>Teléfono de contacto</th>
							<th>Tipo</th>
							<th>Máquina</th>
							<th>Estado</th>
							<th>#OF</th>
							<th>Estado planta</th>
							<th>Mantenimiento</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = (int) $incidencias->firstItem(); ?>
                        @foreach($incidencias as $incidencia)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    @if(!is_null($incidencia->fecha_programada) && $incidencia->fecha_programada != '0000-00-00 00:00:00')
                                        {{ date('d/m/Y', strtotime($incidencia->fecha_programada)) }}
                                    @endif
                                </td>
                                <td>
                                    @if(!is_null($incidencia->fecha_prevision_programacion) && $incidencia->fecha_prevision_programacion != '0000-00-00 00:00:00')
                                        {{ date('d/m/Y', strtotime($incidencia->fecha_prevision_programacion)) }}
                                    @endif
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
                                @if($incidencia->contrato)
                                    <span class="label label-sm label-success">Contrato</span>
                                @else
                                    <span class="label label-sm label-warning">Sin contrato</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{ url('clientes/maquinas/ver?id='.$incidencia->maquina()->pluck('id')) }}">
                                        {{ $incidencia->maquina()->pluck('marca') }}/{{ $incidencia->maquina()->pluck('modelo') }}
                                    </a>
                                </td>
                                <td>
                                     <span class="label label-sm bg-green">
                                         {{ $incidencia->estado }}
                                     </span>
                                </td>
                                <td>
                                    {{ $incidencia->no_of }}
                                </td>
                                <td>
                                    <span class="label label-sm bg-green">Funcionamiento</span>
                                </td>
                                <td>
                                     <span class="label label-sm bg-purple">
                                         Mant. {{ $incidencia->tipo_intervencion()->withTrashed()->pluck('nombre') }}
                                         <span data-original-title="{{ $incidencia->tipo_intervencion()->withTrashed()->pluck('descripcion') }}" class="tooltips" data-trigger="hover" data-container="body" data-placement="right">
                                             <i class="fa fa-question-circle"></i>
                                         </span>
                                     </span>
                                </td>
                                <td>
                                    <a href="{{ url('/incidencias/ver?id='.$incidencia->id) }}" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i> detalles</a>
                                </td>
                            </tr>
                        <?php ++$i; ?>
						@endforeach
						</tbody>
						</table>
					</div>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="paginationInfo" role="status" aria-live="polite">
                                Mostrando <span id="de">{{ $incidencias->firstItem() }}</span> a <span id="a">{{ $incidencias->lastItem() }}</span> de <span id="total">{{ $incidencias->total() }}</span> incidencias
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <div class=" pull-right dataTables_paginate paging_simple_numbers" id="paginationLinks2">
                                {!! $incidencias->appends(Request::except('page'))->render() !!}
                            </div>
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

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    Index.init();
    Index.initDashboardDaterange();
    Tasks.initDashboardWidget();
    ComponentsPickers.init();


});
</script>

@include('common_end')
