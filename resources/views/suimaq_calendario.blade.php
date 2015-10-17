@include('common_header')

<title>Suimaq | Calendario</title>

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
			Calendario
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Inicio</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Calendario</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<div class="row ">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-madison calendar">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-calendar"></i>Calendario
							</div>
						</div>
						<div class="portlet-body light-grey">
							<div class="row">
								<div class="col-md-2 pendientes">
									<h2>Pendientes</h2>
									<a data-toggle="modal" data-target="#draggable" class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#F3565D"><div class="fc-content"><span class="fc-title">Thomann</span></div></a>
									<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#F3565D"><div class="fc-content"><span class="fc-title">ABB</span></div></a>
									<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#F3565D"><div class="fc-content"><span class="fc-title">Vodafone</span></div></a>
								</div>
								<div id="calendar" class="col-md-10">
								</div>
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
{{--Modals--}}
<div class="modal fade draggable-modal ui-draggable" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ui-draggable-handle">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Thomann</h4>
			</div>
			<div class="modal-body">
				 <strong>Máquina:</strong> Combi 8-10/500D <br>
				 <strong>Tipo:</strong> Avería <br>
				 <strong>Fecha de entrada:</strong> 15/04/2015 <br>
				 <strong>#OF:</strong> 125 <br>
				 <strong>Descripción:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper. Nulla pretium sodales leo et consectetur. Fusce magna eros, molestie eu tortor vel, bibendum dictum ante.<br>
				 <strong>Observaciones de la maquina:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius. Suspendisse vulputate nisi neque, non consectetur quam tempor id. Phasellus a leo ut augue viverra sagittis vitae sit amet mauris. Aenean ullamcorper rutrum tincidunt. Mauris tempor turpis vitae lacus porta ullamcorper.<br>
				<strong>Observaciones del cliente:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet ornare arcu. In maximus dolor at eros suscipit varius.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
{{--End modals--}}

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

   $("#draggable").draggable({
      handle: ".modal-header"
  });

});
</script>
@include('common_end')
