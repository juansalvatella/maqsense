@include('common_header')
<title>Suimaq | Admin Dashboard</title>

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
			Ajustes
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{ url('/') }}">Inicio</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Ajustes</a>
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
								<i class="fa fa-arrows"></i>Patrones de intervenciones
							</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<button id="sample_editable_1_new" class="btn green">
								<i class="fa fa-plus"></i> Nuevo patrón
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="table-scrollable">
					<table class="table table-striped table-hover table-bordered dataTable no-footer">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Secuencia</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>ABAC</td>
								<td>A (3) <i class="fa fa-caret-right"></i> B (4) <i class="fa fa-caret-right"></i> A (2) <i class="fa fa-caret-right"></i> C (7) <i class="fa fa-caret-right"></i> A</td>
								<td>
									<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
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
								<button id="sample_editable_1_new" class="btn green">
								<i class="fa fa-plus"></i> Nuevo tipo
								</button>
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
						<tbody>
							<tr>
								<td>A</td>
								<td>Cambio de aceite</td>
								<td>
									<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td>B</td>
								<td>Cambio de motor</td>
								<td>
									<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td>C</td>
								<td>Cambio de filtro</td>
								<td>
									<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
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
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/table-editable.js"></script>
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
   TableEditable.init();

});
</script>

@include('common_end')
