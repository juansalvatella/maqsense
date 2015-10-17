@include('common_header')

@if(Request::is('clientes/maquinas/nueva*'))
    <title>Suimaq | {{ $cliente->nombre }} | Nueva máquina</title>
@elseif(Request::is('clientes/maquinas/editar*'))
    <title>Suimaq | {{ $cliente->nombre }} |maquina</title>
@elseif(Request::is('clientes/maquinas/ver*'))
    <title>Suimaq | {{ $cliente->nombre }} | máquina</title>
@endif

@include('common_css')

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/typeahead/typeahead.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/fileinput.min.css') }}">
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
            @if(Request::is('clientes/maquinas/nueva*'))
                Nueva máquina
            @elseif(Request::is('clientes/maquinas/editar*'))
               máquina
            @elseif(Request::is('clientes/maquinas/ver*'))
                máquina
            @endif
			</h3>
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
                        <i class="fa fa-angle-right"></i>
                    </li>
					<li>
                    @if(Request::is('clientes/maquinas/nueva*'))
                        <a href="javascript:">Nueva máquina</a>
                    @elseif(Request::is('clientes/maquinas/editar*'))
                        <a href="javascript:">Editar máquina</a>
                        <i class="fa fa-angle-right"></i>
                    @elseif(Request::is('clientes/maquinas/ver*'))
                        <a href="javascript:">{{ $maquina->marca }}/{{ $maquina->modelo }}</a>
                    @endif
					</li>
                    @if(Request::is('clientes/maquinas/editar*'))
                    <li>
                        <a href="javascript:">{{ $maquina->marca }}/{{ $maquina->modelo }}</a>
                    </li>
                    @endif
				</ul>
			</div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    @if(Request::is('clientes/maquinas/nueva*'))
                        <i class="fa fa-plus-circle"></i> Nueva máquina
                    @elseif(Request::is('clientes/maquinas/editar*'))
                        <i class="fa fa-pencil-square-o"></i>máquina
                    @elseif(Request::is('clientes/maquinas/ver*'))
                        <i class="fa fa-folder-open-o"></i> Detalles
                    @endif
                    </div>
                </div>
                <div class="portlet-body form">

                @if(Request::is('clientes/maquinas/nueva*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/maquinas/nueva') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @elseif(Request::is('clientes/maquinas/editar*'))
                    <form role="form" class="form-horizontal" method="POST" action="{{ URL::to('/clientes/maquinas/editar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @elseif(Request::is('clientes/maquinas/ver*'))
                    <form role="form" class="form-horizontal">
                @endif
                        <input type="hidden" name="_token" value="{{ Session::getToken() }}">
                        <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                    @if(Request::is('clientes/maquinas/editar*'))
                        <input type="hidden" name="id" value="{{ $maquina->id }}">
                    @endif
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="marca">Marca</label>
                                <div class="col-md-10">
                                @if(Request::is('clientes/maquinas/nueva*'))
                                    <div class="input-group">
                                        <input id="marca" name="marca" class="form-control" placeholder="Marca de la máquina" type="text">
                                    </div>
                                @elseif(Request::is('clientes/maquinas/editar*'))
                                    <div class="input-group">
                                        <input id="marca" name="marca" class="form-control" placeholder="Marca de la máquina" type="text" value="{{ $maquina->marca }}">
                                    </div>
                                @elseif(Request::is('clientes/maquinas/ver*'))
                                    <p class="form-control-static">
                                        {{ $maquina->marca }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="modelo">Modelo</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <input id="modelo" name="modelo" class="form-control" placeholder="Modelo de la máquina" type="text">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <input id="modelo" name="modelo" class="form-control" placeholder="Modelo de la máquina" type="text" value="{{ $maquina->modelo }}">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->modelo }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="doc">Manual</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <input id="doc-input" name="doc" class="file form-control" type="file" data-language="es" data-show-preview="false" data-show-upload="false">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <input id="doc-input" name="doc" class="file form-control" type="file" data-language="es" data-show-preview="false" data-show-upload="false" data-initial-caption="{{ $maquina->doc }}">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <a href="{{ asset('docs/'.$maquina->doc) }}"><i class="fa fa-download"></i> {{ $maquina->doc }}</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="no_serie">N&ordm; de serie</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <input id="no_serie" name="no_serie" class="form-control" placeholder="N&ordm; de serie de la máquina" type="text">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <input id="no_serie" name="no_serie" class="form-control" placeholder="N&ordm; de serie de la máquina" type="text" value="{{ $maquina->no_serie }}">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->no_serie }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="horas_funcionamiento">Horas de funcionamiento</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <input id="horas_funcionamiento" name="horas_funcionamiento" class="form-control" placeholder="Horas de funcionamiento de la máquina" type="text">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <input id="horas_funcionamiento" name="horas_funcionamiento" class="form-control" placeholder="Horas de funcionamiento de la máquina" type="text" value="{{ $maquina->horas_funcionamiento }}">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->horas_funcionamiento }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="no_revisiones_anuales">N&ordm; de revisiones anuales</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <input id="no_revisiones_anuales" name="no_revisiones_anuales" class="form-control" placeholder="N&ordm; de revisiones anuales de la máquina" type="text">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <input id="no_revisiones_anuales" name="no_revisiones_anuales" class="form-control" placeholder="N&ordm; de revisiones anuales de la máquina" type="text" value="{{ $maquina->no_revisiones_anuales }}">
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->no_revisiones_anuales }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="patron_intervenciones">Patrón de intervenciones</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <div class="input-group">
                                            <select class="form-control patrones_id" name="patrones_id">
                                                <option value="">&nbsp;</option>
                                                @foreach(\App\PatronIncidencias::all() as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nombre }} @if(count($p->steps))&#40;@foreach($p->steps as $step){{ $step->tipointervencion()->pluck('nombre') }}@endforeach&#41;@endif</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <div class="input-group">
                                            <select class="form-control patrones_id" name="patrones_id">
                                                <option @if(!$maquina->patrones_id) selected="selected" @endif value="">&nbsp;</option>
                                                @foreach(\App\PatronIncidencias::withTrashed()->get() as $p)
                                                    <option value="{{ $p->id }}" @if($maquina->patrones_id == $p->id) selected="selected" @endif>{{ $p->nombre }} @if(count($p->steps))&#40;@foreach($p->steps as $step){{ $step->tipointervencion()->withTrashed()->pluck('nombre') }}@endforeach&#41;@endif</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->patron()->withTrashed()->pluck('nombre') }} @if($maquina->patron()->withTrashed()->first())&#40;@foreach($maquina->patron()->withTrashed()->first()->steps as $step){{ $step->tipointervencion()->withTrashed()->pluck('nombre') }}@endforeach&#41;@endif
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="pos_intervencion_inicial">Intervenci&oacute;n inicial</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <select disabled="disabled" class="form-control pos_intervencion_inicial" name="pos_intervencion_inicial">
                                            <option value="">&nbsp;</option>
                                        </select>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <select class="form-control pos_intervencion_inicial" name="pos_intervencion_inicial">
                                            @foreach(\App\SecuenciaStep::withTrashed()->where('maquina_id',$maquina->id)->orderBy('posicion','ASC')->get() as $step)
                                            <option value="{{ $step->posicion }}" @if($step->posicion == $maquina->pos_intervencion_inicial) selected="selected" @endif>{{ $step->tipointervencion()->pluck('nombre') }}</option>
                                            @endforeach
                                        </select>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            @if(\App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->where('posicion',$maquina->pos_intervencion_inicial)->count())
                                                {{ \App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->where('posicion',$maquina->pos_intervencion_inicial)->first()->tipointervencion()->pluck('nombre') }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="puesta_en_marcha">Fecha de puesta en marcha</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <input class="form-control date-picker" name="puesta_en_marcha" value="" type="text">
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <input class="form-control date-picker" name="puesta_en_marcha" value="@if(!is_null($maquina->puesta_en_marcha) && $maquina->puesta_en_marcha != '0000-00-00 00:00:00'){{ date('d/m/Y', strtotime($maquina->puesta_en_marcha)) }}@endif" type="text">
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        @if(!is_null($maquina->puesta_en_marcha) && $maquina->puesta_en_marcha != '0000-00-00 00:00:00')
                                            {{ date('d/m/Y', strtotime($maquina->puesta_en_marcha)) }}
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="observaciones">Observaciones</label>
                                <div class="col-md-10">
                                    @if(Request::is('clientes/maquinas/nueva*'))
                                        <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder="Observaciones sobre la máquina"></textarea>
                                    @elseif(Request::is('clientes/maquinas/editar*'))
                                        <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder="Observaciones sobre la máquina">{{ $maquina->observaciones }}</textarea>
                                    @elseif(Request::is('clientes/maquinas/ver*'))
                                        <p class="form-control-static">
                                            {{ $maquina->observaciones }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            @if(!Request::is('clientes/maquinas/ver*'))
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="piezas">Piezas</label>
                                <div class="col-md-10">
                                    <table class="table table-striped table-hover table-bordered dataTable no-footer">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Referencia</th>
                                            <th width="150">Cantidad</th>
                                            <th>Tipo de intervención</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyPiezas">
                                        @if(Request::is('clientes/maquinas/nueva*') || $maquina->piezas->count() == 0)
                                            <tr>
                                                <input type="hidden" class="posicion" name="posicion_1" value="1">
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <div class="input-group">
                                                        <input type="text" class="nombre form-control" name="nombre_1" value="">
                                                    </div>
                                                </td>
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <div class="input-group">
                                                        <input type="text" class="referencia form-control" name="referencia_1" value="">
                                                    </div>
                                                </td>
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="cantidad form-control" name="cantidad_1" value="">
                                                    </div>
                                                </td>
                                                <td valign="middle" align="center" style="vertical-align: middle;">
                                                    @if(Request::is('clientes/maquinas/nueva*'))
                                                    <select disabled="disabled" class="tipo-intervencion form-control" name="tipo-intervencion_1">
                                                        <option value="">&nbsp;</option>
                                                    </select>
                                                    @else
                                                    <select @if(!$maquina->patrones_id) disabled="disabled" @endif class="tipo-intervencion form-control" name="tipo-intervencion_1">
                                                        @if(!$maquina->patrones_id)
                                                            <option value="">&nbsp;</option>
                                                        @else
                                                            @foreach(\App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->orderBy('posicion','ASC')->get() as $step)
                                                                <option value="{{ $step->tipo_intervenciones_id }}">{{ \App\TipoIntervencion::withTrashed()->where('id',$step->tipo_intervenciones_id)->pluck('nombre') }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @endif
                                                </td>
                                                <td valign="middle" align="left" style="vertical-align: middle;">
                                                    <a href="javascript:" class="add-pieza btn default btn-sm green-stripe"><i class="fa fa-plus"></i> A&ntilde;adir</a>
                                                    <a href="javascript:" class="del-pieza btn default btn-sm red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @else
                                            <?php $p = 1; ?>
                                            @foreach($maquina->piezas as $pieza)
                                                <tr>
                                                    <input type="hidden" class="posicion" name="posicion_{{ $p }}" value="{{ $p }}">
                                                    <td valign="middle" align="center" style="vertical-align: middle;">
                                                        <div class="input-group">
                                                            <input type="text" class="nombre form-control" name="nombre_{{ $p }}" value="{{ $pieza->nombre }}">
                                                        </div>
                                                    </td>
                                                    <td valign="middle" align="center" style="vertical-align: middle;">
                                                        <div class="input-group">
                                                            <input type="text" class="referencia form-control" name="referencia_{{ $p }}" value="{{ $pieza->referencia }}">
                                                        </div>
                                                    </td>
                                                    <td valign="middle" align="center" style="vertical-align: middle;">
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="cantidad form-control" name="cantidad_{{ $p }}" value="{{ $pieza->cantidad }}">
                                                        </div>
                                                    </td>
                                                    <td valign="middle" align="center" style="vertical-align: middle;">
                                                        <select @if(!$maquina->patrones_id) disabled="disabled" @endif class="tipo-intervencion form-control" name="tipo-intervencion_{{ $p }}">
                                                        @if(!$maquina->patrones_id)
                                                            <option value="">&nbsp;</option>
                                                        @else
                                                            @foreach(\App\SecuenciaStep::withTrashed()->where('patrones_id',$maquina->patrones_id)->orderBy('posicion','ASC')->get() as $step)
                                                            <option value="{{ $step->tipo_intervenciones_id }}" @if($step->tipo_intervenciones_id == $pieza->tipo_intervenciones_id) selected="selected" @endif>{{ \App\TipoIntervencion::withTrashed()->where('id',$step->tipo_intervenciones_id)->pluck('nombre') }}</option>
                                                            @endforeach
                                                        @endif
                                                        </select>
                                                    </td>
                                                    <td valign="middle" align="left" style="vertical-align: middle;">
                                                        <a href="javascript:" class="add-pieza btn default btn-sm green-stripe"><i class="fa fa-plus"></i> A&ntilde;adir</a>
                                                        <a href="javascript:" class="del-pieza btn default btn-sm red-stripe" data-toggle="confirmation" data-title="¿Confirmar eliminación?" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-ok-class="btn btn-xs btn-success" data-btn-cancel-class="btn btn-xs btn-danger" data-btn-ok-label="Sí" data-btn-cancel-label="No" data-singleton="true" data-popout="true"><i class="fa fa-times"></i> Eliminar</a>
                                                    </td>
                                                </tr>
                                                <?php ++$p; ?>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                @if(Request::is('clientes/maquinas/nueva*') || Request::is('clientes/maquinas/editar*'))
                                    <button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{ url('/clientes/maquinas?id='.$cliente->id) }}" class="btn default">Cancelar</a>
                                @elseif(Request::is('clientes/maquinas/ver*'))
                                    <a href="{{ URL::previous() }}" class="btn default">Volver</a>
                                @endif
                                </div>
                            </div>
                        </div>

                @if(Request::is('clientes/maquinas/nueva*'))
                    </form>
                @elseif(Request::is('clientes/maquinas/editar*'))
                    </form>
                @elseif(Request::is('clientes/maquinas/ver*'))
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
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/typeahead/handlebars.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/typeahead/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="{{ asset('') }}assets/global/scripts/metronic.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/layout.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/quick-sidebar.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/admin/layout/scripts/demo.js"></script>

<script type="text/javascript" src="{{ asset('js/fileinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fileinput_locale_es.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
    });

    $('.date-picker').datepicker({
        orientation: 'auto',
        todayHighlight: true,
        todayBtn: true,
        language: 'es',
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $('select.patrones_id').on('change', function() {
        var posDropdown = $('select.pos_intervencion_inicial');
        posDropdown.prop('disabled',false);
        var piezDropdown = $('.tipo-intervencion');
        piezDropdown.prop('disabled', false);
        var tokenVal = $('input[name=_token]').val();
        var selectedPatronId = $(this).val();
        $.post('/clientes/maquinas/fillStepsDropdown', {
            _token: tokenVal,
            idPatron: selectedPatronId
        }, function(data) { //handle response
            posDropdown.empty();
            piezDropdown.empty();
            if(data.length < 1) {
                posDropdown.prop('disabled', true);
                piezDropdown.prop('disabled', true);
            } else {
                $.each(data, function (index, value) {
                    posDropdown.append($("<option />").val(data[index].posicion).text(data[index].texto));
                    piezDropdown.append($("<option />").val(data[index].tipo_intervenciones_id).text(data[index].texto));
                });
            }
        });
    });

    var tbodyPiezas = $("#tbodyPiezas");

    tbodyPiezas.on('click','.add-pieza',function() {
        var posAddBtn = $(this);
        var thisTr = posAddBtn.closest('tr');
        thisTr.clone().hide().insertAfter(thisTr).fadeIn();
        modifyAllAfter(thisTr.next(),'increase');
    });
    tbodyPiezas.on('click','.del-pieza',function() {
        var posDelBtn = $(this);
        var thisTr = posDelBtn.closest('tr');
        var rowCount = $('#tbodyPiezas').find('tr').length;
        if(rowCount > 1) {
            modifyAllAfter(thisTr.next(), 'decrease');
            thisTr.fadeOut(function () {
                thisTr.remove();
            });
        }
    });
    var modifyAllAfter = (function(objTr,mode) {
        if(!objTr.length)
            return false;
        var modPos;
        if(mode=='decrease')
            modPos = parseInt(objTr.find('.posicion').attr('value')) - 1;
        else
            modPos = parseInt(objTr.find('.posicion').attr('value')) + 1;
        objTr.find('.posicion').attr('name',solveIncreaseEtCoagula(objTr.find('.posicion').attr('name'),modPos));
        objTr.find('.nombre').attr('name',solveIncreaseEtCoagula(objTr.find('.nombre').attr('name'),modPos));
        objTr.find('.referencia').attr('name',solveIncreaseEtCoagula(objTr.find('.referencia').attr('name'),modPos));
        objTr.find('.cantidad').attr('name',solveIncreaseEtCoagula(objTr.find('.cantidad').attr('name'),modPos));
        objTr.find('.tipo-intervencion').attr('name',solveIncreaseEtCoagula(objTr.find('.tipo-intervencion').attr('name'),modPos));
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
