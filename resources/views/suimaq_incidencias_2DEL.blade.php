@include('common_header')

<title>Suimaq | Admin Incidencias</title>

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
			Incidencias
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-wrench"></i>
                        <a href="#">Incidencias</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-exclamation-triangle"></i>¡Urgentes!
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse">
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-responsive">
						<table class="table">
						<thead>
						<tr>
							<th>
								 #
							</th>
							<th>
								Intervención
							</th>
							<th>
								Estado
							</th>
							<th>
								Cliente
							</th>
							<th>
								 Tipo
							</th>
							<th>
								 Máquina
							</th>
							<th>
								 # OF
							</th>
							<th>
								Acciones
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								 1
							</td>
							<td class="danger">
								01/03/2015
							</td>
							<td>
								 <span class="label label-sm bg-green">Programable</span>
							</td>
							<td>
								<a href="javascript::"> Bosch </a>
							</td>
							<td>
								 <span class="label label-sm bg-purple">Mant. A <span class="tooltips" data-trigger="hover" data-container="body" data-placement="right" data-original-title="Cambio de aceite"><i class="fa fa-question-circle"></i></span></span>
							</td>
							<td>
								<a href="javascript::"> Combi 8-10/500D </a>
							</td>
							<td>
								 1440
							</td>
							<td>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i> Ver</a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Editar </a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="10">
								<p><strong>Descripción:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper. Nulla pretium sodales leo et consectetur. Fusce magna eros, molestie eu tortor vel, bibendum dictum ante.</p>
								<p><strong>Observaciones de la maquina:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper.</p>
								<p><strong>Observaciones del cliente:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius.</p>
							</td>
						</tr>
						<tr>
							<td>
								2
							</td>
							<td class="danger">
								02/04/2015
							</td>
							<td>
								 <span class="label label-sm bg-green">Programable</span>
							</td>
							<td>
								<a href="javascript::"> Bosch </a>
							</td>
							<td>
								 <span class="label label-sm bg-purple">Mant. A <span class="tooltips" data-trigger="hover" data-container="body" data-placement="right" data-original-title="Cambio de aceite"><i class="fa fa-question-circle"></i></span></span>
							</td>
							<td>
								<a href="javascript::"> Combi 8-10/500D </a>
							</td>
							<td>
								 1440
							</td>
							<td>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i> Ver</a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Editar </a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="10">
								<p><strong>Descripción:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper. Nulla pretium sodales leo et consectetur. Fusce magna eros, molestie eu tortor vel, bibendum dictum ante.</p>
								<p><strong>Observaciones de la maquina:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper.</p>
								<p><strong>Observaciones del cliente:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius.</p>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet">
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
									<button id="" class="btn green">
									<i class="fa fa-plus"></i> Nueva incidencia
									</button>
								</div>
							</div>
							<div class="col-md-6">
								
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
						<thead>
						<tr>
							<th>
								 #
							</th>
							<th>
								Intervención
							</th>
							<th>
								Estado
							</th>
							<th>
								Cliente
							</th>
							<th>
								 Tipo
							</th>
							<th>
								 Máquina
							</th>
							<th>
								 # OF
							</th>
							<th>
								Acciones
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								 1
							</td>
							<td>
								01/03/2015
							</td>
							<td>
								 <span class="label label-sm bg-green">Programable</span>
							</td>
							<td>
								<a href="javascript::"> Bosch </a>
							</td>
							<td>
								 <span class="label label-sm bg-purple">Mant. A <span class="tooltips" data-trigger="hover" data-container="body" data-placement="right" data-original-title="Cambio de aceite"><i class="fa fa-question-circle"></i></span></span>
							</td>
							<td>
								<a href="javascript::"> Combi 8-10/500D </a>
							</td>
							<td>
								 1440
							</td>
							<td>
								<a href="#" class="btn default btn-xs blue-stripe"><i class="fa fa-eye"></i> Ver</a>
								<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Editar </a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="10">
								<p><strong>Descripción:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper. Nulla pretium sodales leo et consectetur. Fusce magna eros, molestie eu tortor vel, bibendum dictum ante.</p>
								<p><strong>Observaciones de la maquina:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper.</p>
								<p><strong>Observaciones del cliente:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius.</p>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class="dataTables_info" id="sample_2_info" role="status" aria-live="polite">Showing 1 to 12 of 12 entries</div>
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
