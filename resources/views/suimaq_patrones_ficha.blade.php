@include('common_header')

@if(Request::is('intervenciones/patrones/nuevo*'))
    <title>Suimaq | Nuevo patrón de intervenciones</title>
@elseif(Request::is('intervenciones/patrones/editar*'))
    <title>Suimaq |patrón de intervenciones</title>
@elseif(Request::is('intervenciones/patrones/ver*'))
    <title>Suimaq | patrón de intervenciones</title>
@endif

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/typeahead/typeahead.css">
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
            @if(Request::is('intervenciones/patrones/nuevo*'))
                Nuevo patrón de intervenciones
            @elseif(Request::is('intervenciones/patrones/editar*'))
               patrón de intervenciones
            @elseif(Request::is('intervenciones/patrones/ver*'))
                patrón de intervenciones
            @endif
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-cogs"></i>
						<a href="{{ url('intervenciones') }}">Intervenciones</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
                    @if(Request::is('intervenciones/patrones/nuevo*'))
                        <a href="javascript:">Nuevo patrón de intervenciones</a>
                    @elseif(Request::is('intervenciones/patrones/editar*'))
                        <a href="javascript:">Editar patrón de intervenciones</a>
                        <i class="fa fa-angle-right"></i>
                    @elseif(Request::is('intervenciones/patrones/ver*'))
                        <a href="javascript:">{{ $patron->nombre }}</a>
                    @endif
					</li>
                    @if(Request::is('intervenciones/patrones/editar*'))
                    <li>
                        <a href="javascript:">{{ $patron->nombre }}</a>
                    </li>
                    @endif
				</ul>
			</div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    @if(Request::is('intervenciones/patrones/nuevo*'))
                        <i class="fa fa-plus-circle"></i> Nuevo patrón de intervenciones
                    @elseif(Request::is('intervenciones/patrones/editar*'))
                        <i class="fa fa-pencil-square-o"></i>patrón de intervenciones
                    @elseif(Request::is('intervenciones/patrones/ver*'))
                        <i class="fa fa-folder-open-o"></i> Detalles
                    @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('intervenciones/patrones/nuevo*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/intervenciones/patrones/nuevo') }}" accept-charset="UTF-8">
                @elseif(Request::is('intervenciones/patrones/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/intervenciones/patrones/editar') }}" accept-charset="UTF-8">
                @elseif(Request::is('intervenciones/patrones/ver*'))
                    <form role="form" class="form-horizontal">
                @endif
                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                    @if(Request::is('intervenciones/patrones/editar*'))
                        <input type="hidden" name="id" value="{{ $patron->id }}">
                    @endif
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nombre">Nombre</label>
                                <div class="col-md-10">
                                @if(Request::is('intervenciones/patrones/nuevo*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del patrón de intervenciones" type="text">
                                    </div>
                                @elseif(Request::is('intervenciones/patrones/editar*'))
                                    <div class="input-group">
                                        <input id="nombre" name="nombre" class="form-control" placeholder="Nombre del patrón de intervenciones" type="text" value="{{ $patron->nombre }}">
                                    </div>
                                @elseif(Request::is('intervenciones/patrones/ver*'))
                                    <p class="form-control-static">
                                        {{ $patron->nombre }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Secuencia">Secuencia</label>
                                <div class="col-md-10">
                                    <table class="table table-striped table-hover table-bordered dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Posición</th>
                                                {{--<th width="35">Periodo</th>--}}
                                                <th>Tipo de intervención</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodySteps">
                                        @if(Request::is('intervenciones/patrones/nuevo*'))
                                            <tr>
                                                <input type="hidden" class="posicion" name="posicion_1" value="1">
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <a class="pos-up" href="javascript:">
                                                        <i class="fa fa-caret-square-o-up fa-2 text-success"></i>
                                                    </a>
                                                    <a class="pos-down" href="javascript:">
                                                        <i class="fa fa-caret-square-o-down fa-2 text-warning"></i>
                                                    </a>
                                                </td>
                                                {{--<td valign="middle" align="center" style="vertical-align: middle;">--}}
                                                    {{--<div class="input-group">--}}
                                                        {{--<input class="periodo form-control" type="text" name="periodo_1">--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <select class="form-control tipo_intervencion" name="tipo_intervencion_1">
                                                        @foreach($tipos as $t)
                                                            <option value="{{ $t->id }}">{{ $t->nombre }} ({{ $t->descripcion }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td valign="middle" align="left" style="vertical-align: middle;">
                                                    <a href="javascript:" class="add-step btn default btn-sm green-stripe"><i class="fa fa-plus"></i> A&ntilde;adir</a>
                                                    <a href="javascript:" class="del-step btn default btn-sm red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                    @elseif(Request::is('intervenciones/patrones/editar*'))
                                        <?php $j=1; ?>
                                        @foreach($steps as $step)
                                            <tr>
                                                <input type="hidden" class="posicion" name="posicion_{{ $j }}" value="{{ $j }}">
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <a class="pos-up" href="javascript:">
                                                        <i class="fa fa-caret-square-o-up fa-2 text-success"></i>
                                                    </a>
                                                    <a class="pos-down" href="javascript:">
                                                        <i class="fa fa-caret-square-o-down fa-2 text-warning"></i>
                                                    </a>
                                                </td>
                                                {{--<td valign="middle" align="center" style="vertical-align: middle;">--}}
                                                    {{--<div class="input-group">--}}
                                                        {{--<input class="periodo form-control" type="text" name="periodo_{{$j}}" value="{{ $step->periodo }}">--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <select class="form-control tipo_intervencion" name="tipo_intervencion_{{$j}}">
                                                        @foreach($tipos as $t)
                                                            <option value="{{ $t->id }}" @if($step->tipo_intervenciones_id == $t->id) selected="selected" @endif>{{ $t->nombre }} ({{ $t->descripcion }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td valign="middle" align="left" style="vertical-align: middle;">
                                                    <a href="javascript:" class="add-step btn default btn-sm green-stripe"><i class="fa fa-plus"></i> A&ntilde;adir</a>
                                                    <a href="javascript:" class="del-step btn default btn-sm red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        <?php ++$j; ?>
                                        @endforeach
                                    @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                @if(Request::is('intervenciones/patrones/nuevo*') || Request::is('intervenciones/patrones/editar*'))
                                    <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{ url('/intervenciones') }}" class="btn default">Cancelar</a>
                                @elseif(Request::is('intervenciones/patrones/ver*'))
                                    <a href="{{ URL::previous() }}" class="btn default">Volver</a>
                                @endif
                                </div>
                            </div>
                        </div>

                @if(Request::is('intervenciones/patrones/nuevo*'))
                    </form>
                @elseif(Request::is('intervenciones/patrones/editar*'))
                    </form>
                @elseif(Request::is('intervenciones/patrones/ver*'))
                    </form>
                @endif
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
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('') }}assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script src="{{ asset('js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/fileinput_locale_es.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
    });

    var tbodySteps = $("#tbodySteps");
    tbodySteps.on('click','.pos-up',function() {
        var posUpBtn = $(this);
        var thisTr = posUpBtn.closest('tr');
        var prevTr = thisTr.prev();
        thisTr.fadeOut(function(){
            prevTr.before(thisTr);
        }); prevTr.fadeOut();
        thisTr.fadeIn(); prevTr.fadeIn();
        swapAttr(thisTr.find('.posicion'),prevTr.find('.posicion'),'name');
        swapAttr(thisTr.find('.posicion'),prevTr.find('.posicion'),'value');
//        swapAttr(thisTr.find('.periodo'),prevTr.find('.periodo'),'name');
        swapAttr(thisTr.find('.tipo_intervencion'),prevTr.find('.tipo_intervencion'),'name');
    });
    tbodySteps.on('click','.pos-down',function() {
        var posDownBtn = $(this);
        var thisTr = posDownBtn.closest('tr');
        var nextTr = thisTr.next();
        thisTr.fadeOut(function(){
            nextTr.after(thisTr);
        }); nextTr.fadeOut();
        thisTr.fadeIn(); nextTr.fadeIn();
        swapAttr(thisTr.find('.posicion'),nextTr.find('.posicion'),'name');
        swapAttr(thisTr.find('.posicion'),nextTr.find('.posicion'),'value');
//        swapAttr(thisTr.find('.periodo'),nextTr.find('.periodo'),'name');
        swapAttr(thisTr.find('.tipo_intervencion'),nextTr.find('.tipo_intervencion'),'name');
    });
    tbodySteps.on('click','.add-step',function() {
        var posAddBtn = $(this);
        var thisTr = posAddBtn.closest('tr');
        thisTr.clone().hide().insertAfter(thisTr).fadeIn();
        modifyAllAfter(thisTr.next(),'increase');
    });
    tbodySteps.on('click','.del-step',function() {
        var posDelBtn = $(this);
        var thisTr = posDelBtn.closest('tr');
        var rowCount = $('#tbodySteps').find('tr').length;
        if(rowCount > 1) {
            modifyAllAfter(thisTr.next(), 'decrease');
            thisTr.fadeOut(function () {
                thisTr.remove();
            });
        }
    });
    var swapAttr = (function(obj1,obj2,attrName) {
        if(obj1 && obj2 && attrName) {
            var obj1Name = obj1.attr(attrName);
            obj1.attr(attrName, obj2.attr(attrName));
            obj2.attr(attrName, obj1Name);
        }
        return false;
    });
    var modifyAllAfter = (function(objTr,mode) {
        if(!objTr.length)
            return false;

        //get increased position value
        var modPos;
        if(mode=='decrease')
            modPos = parseInt(objTr.find('.posicion').attr('value')) - 1;
        else
            modPos = parseInt(objTr.find('.posicion').attr('value')) + 1;
        //modify names
        objTr.find('.posicion').attr('name',solveIncreaseEtCoagula(objTr.find('.posicion').attr('name'),modPos));
//        objTr.find('.periodo').attr('name',solveIncreaseEtCoagula(objTr.find('.periodo').attr('name'),modPos));
        objTr.find('.tipo_intervencion').attr('name',solveIncreaseEtCoagula(objTr.find('.tipo_intervencion').attr('name'),modPos));
        //modify position value
        objTr.find('.posicion').attr('value',modPos);

        //recursion
        modifyAllAfter(objTr.next(),mode);
    });
    var solveIncreaseEtCoagula = (function(name,newVal) {
        var arrName = name.split('_');
        arrName[arrName.length-1] = ''+newVal;
        var newName = '';
        for(var i = 0; i < arrName.length; ++i) {
            if(i==0)
                newName += arrName[i];
            else
                newName += '_'+arrName[i];
        }
        return newName;
    });

</script>

@include('common_end')
