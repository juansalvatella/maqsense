@include('common_header')

<title>Suimaq | Nuevo cliente</title>

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
			Añadir Cliente
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Inicio</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Clientes</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Añadir</a>
					</li>
				</ul>
			</div>
			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="form">
			<form action="#" class="horizontal-form">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label">Nombre</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="¿Cómo se llama la empresa?">
					</div>
					<div class="form-group">
						<label class="control-label">Persona de contacto</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="¿Cómo se llama la persona de contacto de la empresa?">
					</div>
					<div class="form-group">
						<label class="control-label">Teléfono</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="¿Cuál es el número de teléfono de la empresa?">
					</div>
					<div class="form-group">
						<label class="control-label">Dirección de la oficina</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="¿Dónde está la oficina de la empresa?">
					</div>
					<div class="form-group">
						<label class="control-label">Observaciones</label>
						<textarea class="form-control" placeholder="¿Algo que añadir?"></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">VIP</label>
						<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-animate">
							<div class="bootstrap-switch-container">
								<input type="checkbox" class="make-switch" checked="" data-on="success" data-off="warning">
							</div>
						</div>
					</div>
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Máquinas
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<button id="sample_editable_1_new" class="btn green">
											<i class="fa fa-plus"></i> Nueva máquina
											</button>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>#</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Número de serie</th>
								<th>Horas</th>
								<th>Rev.</th>
								<th>Patrón int.</th>
								<th>Localización</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>Worthington</td>
								<td>RLR220 | <a href="#"><small><i class="fa fa-download"></i></small></a></td>
								<td>F130087</td>
								<td>500</td>
								<td>3</td>
								<td>ABAC</td>
								<td>Avinguda Garrigues 23 Lleida 25001 | <a href="#"><small><i class="fa fa-map-marker"></i> Cómo llegar</small></a> </td>
								<td>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i></a>
								<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Worthington</td>
								<td>RLR220 | <a href="#"><small><i class="fa fa-download"></i></small></a></td>
								<td>F130087</td>
								<td>500</td>
								<td>3</td>
								<td>ABAC</td>
								<td>Avinguda Garrigues 23 Lleida 25001 | <a href="#"><small><i class="fa fa-map-marker"></i> Cómo llegar</small></a> </td>
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
				<div class="form-actions">
					<div class="row">
						<div class="col-md-9">
							<button type="submit" class="btn green">Añadir</button>
							<button type="button" class="btn default">Cancelar</button>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->

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
