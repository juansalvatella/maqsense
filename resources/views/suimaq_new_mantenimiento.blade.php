@include('common_header')

<title>Suimaq | Admin Incidencias</title>

@include('common_css')

<!-- SELECT -->
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/select2/select2.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-multi-select/css/multi-select.css">
<!-- END SELECT -->
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
			Añadir Incidencia
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Inicio</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Incidencias</a>
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
						<label class="control-label">Tipo de incidencia</label>
							<select class="form-control input-xlarge">
								<option value="">Selecciona el tipo de incidencia</option>
								<option value="">Puesta en marcha</option>
								<option value="">Avería</option>
							</select>
					</div>
					<div class="form-group">
						<label class="control-label">Cliente</label>
						<div class="input-group input-xlarge">
							<div class="input-icon">
								<select class="form-control select2me">
									<option value="">Selecciona el cliente</option>
									<option value="">Samsung</option>
									<option value="">Bosch</option>
								</select>
							</div>
							<span class="input-group-btn">
								<button id="genpassword" class="btn btn-success" type="button"><i class="fa fa-plus fa-fw"></i> Añadir</button>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Máquina</label>
						<div class="input-group input-xlarge">
							<div class="input-icon">
								<select class="form-control select2me">
									<option value="">Selecciona la máquina</option>
									<option value="">ATT 1234 BS</option>
								</select>
							</div>
							<span class="input-group-btn">
								<button id="genpassword" class="btn btn-success" type="button"><i class="fa fa-plus fa-fw"></i> Añadir</button>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Descripción</label>
						<textarea class="form-control" placeholder="¿Qué ha pasado?"></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">#OF</label>
						<input id="name" class="form-control input-medium" type="text" name="name" placeholder="¿Qué número de OF tiene?">
					</div>
					<div class="form-group">
						<label class="control-label">Fecha intervención</label>
						<input id="name" class="form-control input-medium" readonly type="text" name="name" placeholder="¿Cuando se hará la intervención?">
					</div>
					<div class="form-group">
						<label class="control-label">Estado</label>
						<div class="input-group input-xlarge">
							<select class="form-control">
								<option value="">Selecciona un estado</option>
								<option value="">Abierta</option>
								<option value="">Programable</option>
								<option value="">Programada</option>
								<option value="">Cerrada</option>
							</select>
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
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- BEGIN SELECT RELATED JS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END SELECT RELATED JS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
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
