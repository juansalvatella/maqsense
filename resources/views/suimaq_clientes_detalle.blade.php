@include('common_header')

<title>Suimaq | Clientes detalle</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
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
			<h3 class="page-title">
			Clientes
			</h3>
			<div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Inicio</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="suimaq_clientes_detalle.html">Clientes</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Detalle</a>
                    </li>
                </ul>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<button id="sample_editable_1_new" class="btn green">
								<i class="fa fa-plus"></i> Nuevo cliente
								</button>
							</div>
						</div>
						<div class="col-md-6">
							<label class="pull-right">Buscar: <input type="search" class="form-control input-large input-inline" placeholder="Ej: Bosch, Samsung, Phillips, ..." aria-controls="sample_1"></label>
						</div>
					</div>
				</div>
				<div class="table-scrollable">
					<table class="table table-striped table-hover table-bordered dataTable no-footer">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Persona de contacto</th>
								<th>Teléfono</th>
								<th>Dirección</th>
								<th>Maquinaria</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Bosch</td>
								<td>Joan Salvatella</td>
								<td>931 003 938</td>
								<td>Avinguda Garrigues 23 Lleida 25001</td>
								<td><a href="suimaq_maquinas.html">3 maquinas</a></td>
								<td>
								<a href="#" class="btn default btn-xs purple-stripe"><i class="fa fa-history"></i></a>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i></a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
								<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Samsung</td>
								<td>Marc Pasarisa</td>
								<td>931 003 938</td>
								<td>Carrer Numancia 20 Barcelona 08029</td>
								<td><a href="#">1 maquina</a></td>
								<td>
								<a href="#" class="btn default btn-xs purple-stripe"><i class="fa fa-history"></i></a>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i></a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
								<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Bosch</td>
								<td>Òscar Gasulla</td>
								<td>931 003 938</td>
								<td>Carrer Pi i Margall 98 Barcelona 08005</td>
								<td><a href="#">2 maquinas</a></td>
								<td>
								<a href="#" class="btn default btn-xs purple-stripe"><i class="fa fa-history"></i></a>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i></a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
								<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class="dataTables_info" id="sample_2_info" role="status" aria-live="polite">Showing 1 to 3 of 3 entries</div>
						</div>
						<div class="col-md-7 col-sm-12">
							<div class=" pull-right dataTables_paginate paging_simple_numbers" id="sample_2_paginate">
								<ul class="pagination">
									<li class="paginate_button previous disabled" aria-controls="sample_2" tabindex="0" id="sample_2_previous">
										<a href="#"><i class="fa fa-angle-left"></i></a>
									</li>
									<li class="paginate_button active" aria-controls="sample_2" tabindex="0">
										<a href="#">1</a>
									</li>
									<li class="paginate_button next disabled" aria-controls="sample_2" tabindex="0" id="sample_2_next">
										<a href="#"><i class="fa fa-angle-right"></i></a>
									</li>
								</ul>
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
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
});
</script>

@include('common_end')
