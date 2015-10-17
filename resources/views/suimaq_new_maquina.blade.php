@include('common_header')

<title>Suimaq | Nueva máquina</title>

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('') }}assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN SELECT STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/select2/select2.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-multi-select/css/multi-select.css">
<!-- END SELECT -->
<!-- BEGIN PAGE STYLES -->
<link href="{{ asset('') }}assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/css/datepicker3.css">
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
			Añadir Máquina
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
						<a href="#">Máquinas</a>
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
						<label class="control-label">Marca</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿De qué marca es la máquina?">
					</div>
					<div class="form-group">
						<label class="control-label">Modelo</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿Qué modelo es?">
					</div>
					<div class="form-group">
						<label class="control-label">Número de serie</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿Qué número de serie tiene?">
					</div>
					<div class="form-group">
						<label class="control-label">Horas de funcionamiento anual</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿Cuantas horas está la máquina en funcionamiento durante un año?">
					</div>
					<div class="form-group">
						<label class="control-label">Revisiones anuales</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿Cuantas revisiones se le hacen a la máquina en un año?">
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Patrón de intervenciones</label>
						<select class="form-control select2me" data-placeholder="Select...">
							<option value="">Selecciona el patrón de intervenciones</option>
							<option value="">ABC</option>
							<option value="">ACAB</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Hoja Check control</label>
						<input id="name" class="form-control input-xlarge" type="text" name="name" placeholder="¿Qué número de hoja tiene asignado?">
					</div>
					<div class="form-group">
						<label for="exampleInputFile1">Contrato</label>
						<input type="file" id="">
						<p class="help-block">
							Selecciona el contrato en formato PDF vinculado a esta máquina
						</p>
					</div>
					<div class="form-group">
						<label class="control-label" for="puesta_en_marcha">Puesta en marcha</label>
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
							<input type="text" class="form-control">
							<span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						<!-- /input-group -->
						<span class="help-block">
						Selecciona la fecha de la puesta en marcha</span>
					</div>
					<div class="form-group">
						<label class="control-label">Observaciones</label>
						<textarea class="form-control" placeholder="¿Algo que añadir?" height="200"></textarea>
					</div>
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Piezas
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<button id="sample_editable_1_new" class="btn green">
											<i class="fa fa-plus"></i> Nueva pieza
											</button>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>Nombre</th>
								<th>Referencia</th>
								<th>Cantidad</th>
								<th>Tipo de intervención</th>
								<th>Acciones</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Tornillo</td>
								<td>TRN1234</td>
								<td>4</td>
								<td>A</td>
								<td>
									<a href="#" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Editar </a>
									<a href="#" class="btn default btn-xs red-stripe"><i class="fa fa-times"></i> Eliminar</a>
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
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('') }}assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN SELECT RELATED JS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END SELECT RELATED JS -->
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
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
   TableEditable.init();
   ComponentsPickers.init();
});
</script>

@include('common_end')
