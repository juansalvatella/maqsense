<?php namespace App\Http\Controllers;

use App\Cliente;
use App\Incidencia;
use App\Maquina;
use App\PatronIncidencias;
use App\Pieza;
use App\SecuenciaStep;
use App\TipoIntervencion;
use Carbon\Carbon;

class SuimaqController extends Controller {

    public function __construct()
    {
//        $this->middleware('auth'); //authenticated access only
        $this->middleware('guest'); //everyone allowed
    }

    private function nextPosition($current, $total)
    {
        if($current + 1 >= $total)
            return 1;
        else
            return $current + 1;
    }

    private function updateDates($maquina_id, $modified_incidence_id, $modification_mode = 'fecha_prevision_programacion') {
        //Obtenemos datos de la máquina
        $maquina = Maquina::find($maquina_id);
        //Obtenemos datos de la incidencia cuya fecha ha sido modificada
        $mod_incidence = Incidencia::find($modified_incidence_id);
        //Obtenemos el resto de incidencias asociadas al mismo patrón que sean posteriores a la modificada
        $following_incidences = Incidencia::where('tipo','Mantenimiento programado')
            ->where('maquina_id',$maquina_id)
            ->where('seguimiento','>',$mod_incidence->seguimiento)
            ->get();

        $prev_incidence = $mod_incidence;
        if($modification_mode == 'fecha_prevision_programacion') //se ha cambiado la fecha de previsión de una incidencia
            $reference_date = $prev_incidence->fecha_prevision_programacion;
        else //se ha cambiado (asignado, modificado) la fecha de programación a una incidencia
            $reference_date = $prev_incidence->fecha_programada;

        foreach($following_incidences as $incidence)
        {
            $periodo = SecuenciaStep::where('maquina_id',$maquina_id)->where('posicion',$prev_incidence->step_posicion)->pluck('periodo');
            $new_date = $reference_date->addDays($periodo);
            $incidence->fecha_prevision_programacion = $new_date;
            if(!$incidence->save())
                return false;

            $prev_incidence = $incidence;
            $reference_date = $new_date;
        }

        return true;
    }

    private function updateIncidencias($maquina_id, $new_pattern_mode = false)
    {
        //Obtenemos datos de la máquina
        $maquina = Maquina::find($maquina_id);
        $rev_anuales = $maquina->no_revisiones_anuales;
        $pos_step_inicial = $maquina->pos_intervencion_inicial;
        //Obtenemos datos sobre el tipo de secuencia modelo que deben seguir las intervenciones
        $sequence_model = SecuenciaStep::where('patrones_id',$maquina->patrones_id)->orderBy('posicion','ASC')->get();
        $n_steps = count($sequence_model);
        //Calculamos el periodo o margen de tiempo (en días) entre las intervenciones, a partir del número de revisiones anuales
        $periodo = (int) 365/$rev_anuales;
        //Calculamos el número máximo de "vueltas" que daremos a la secuencia a partir de los datos conocidos
        $n_loops = (int) ceil($rev_anuales/count($sequence_model)) + 1;

        //¿Existen incidencias previamente creadas según el patrón de esta máquina?
        $existing_incidences = Incidencia::where('maquina_id',$maquina_id)->where('tipo','Mantenimiento programado')->orderBy('fecha_prevision_programacion','ASC')->get();
        $prev_incidences_exists = (count($existing_incidences)) ? true : false;

        if($prev_incidences_exists && !$new_pattern_mode) { //Generar nuevas incidencias a partir de la última, hasta que cubramos un año vista contando desde ahora
            $previous_incidence = Incidencia::where('tipo','Mantenimiento programado')->where('maquina_id',$maquina_id)->orderBy('fecha_prevision_programacion','DESC')->first();
            $previous_date = ($previous_incidence->fecha_programada) ? $previous_incidence->fecha_programada : $previous_incidence->fecha_prevision_programacion;
            $current_date = Carbon::now();
            $max_date = $current_date->addYear();
            //loop while date of the last created is lesser or equal than the date of a year from now
            for($next_date = $previous_date->addDays($periodo); $next_date->lte($max_date); $next_date = $next_date->addDays($current_step->periodo))
            {
                //TODO: supongo que los periodos asociados a los steps son el periodo de tiempo hasta el proximo step
                $current_step = SecuenciaStep::where('maquina_id',$maquina->id)
                    ->where('posicion', $this->nextPosition($previous_incidence->step_posicion,$n_steps))
                    ->first();
                \Log::info(''.$current_step->posicion);
                $previous_incidence = Incidencia::create([ //once created it becomes the reference, the 'previous' one
                    'fecha_programada' => null,
                    'fecha_prevision_programacion' => $next_date,
                    'estado' => 'Sin OF',
                    'tipo' => 'Mantenimiento programado',
                    'step_posicion' => $current_step->posicion,
                    'seguimiento' => $previous_incidence->seguimiento + 1,
                    'descripcion' => 'Mantenimiento generado automáticamente',
                    'no_of' => null,
                    'contrato' => false,
                    'check_material' => false,
                    'urgente' => false,
                    'cliente_id' => $maquina->cliente()->pluck('id'),
                    'maquina_id' => $maquina->id,
                    'tipo_intervenciones_id' => $current_step->tipo_intervenciones_id
                ]);
            }
        } else { //Si no existen incidencias previamente programadas generamos incidencias A UN AÑO VISTA
            //Eliminamos cualquier secuencia de steps asociada a la máquina que pudiera existir con anterioridad (se espera que sólo haya una secuencia por máquina)
            SecuenciaStep::where('maquina_id',$maquina->id)->forceDelete();
            //Creamos una secuencia de steps asociada a la máquina. Esta secuencia contiene detalles sobre los periodos de cada step
            foreach($sequence_model as $step) {
                SecuenciaStep::create([
                    'posicion' => $step->posicion,
                    'periodo'  => $periodo,
                    'tipo_intervenciones_id' => $step->tipo_intervenciones_id,
                    'patrones_id' => null, //IMPORTANTE! esto distingue el modelo de steps prototipo (asociado a un patrón) del asociado a una máquina (con detalles como el periodo de los steps)
                    'maquina_id' => $maquina->id
                ]);
            }
            //Obtenemos la secuencia recién creada
            $sequence_model = SecuenciaStep::where('maquina_id',$maquina->id)->orderBy('posicion','ASC')->get();

            if($new_pattern_mode) {
                //Modificamos o eliminamos las viejas incidencias generadas a partir del viejo patrón de incidencias
                foreach($existing_incidences as $incidence) {
                    if($incidence->estado == 'Programada' || $incidence->estado == 'Cerrada') {
                        $incidence->tipo = 'Mantenimiento programado (patrón descontinuado)';
                        $incidence->save();
                    } else {
                        $incidence->forceDelete();
                    }
                }
            }

            //Creamos las nuevas incidencias
            $i = 0; //Contador de incidencias generadas
            $first_set = false;
            for($loop=0; $loop<$n_loops; ++$loop) { //recorremos el modelo tantas veces como sean necesarias
                foreach($sequence_model as $step) {
                    if(!$first_set && ($step->posicion != $pos_step_inicial))
                        continue;
                    elseif(!$first_set)
                        $first_set = true;
                    Incidencia::create([
                        'fecha_programada' => null,
                        'fecha_prevision_programacion' => Carbon::createFromTimestamp(strtotime($maquina->puesta_en_marcha))->addDays($step->periodo * $i),
                        'estado' => 'Sin OF',
                        'tipo' => 'Mantenimiento programado',
                        'seguimiento' => $i,
                        'step_posicion' => $step->posicion,
                        'descripcion' => 'Mantenimiento generado automáticamente',
                        'no_of' => null,
                        'contrato' => false,
                        'check_material' => false,
                        'urgente' => false,
                        'cliente_id' => $maquina->cliente()->pluck('id'),
                        'maquina_id' => $maquina->id,
                        'tipo_intervenciones_id' => $step->tipo_intervenciones_id
                    ]);
                    ++$i;
                    if($i >= $rev_anuales)
                        break 2;
                }
            }
        }

        return true;
    }

    //LOGIN AND HOME
    public function index()
    {
        return view('home_l5_ex');
    }

    public function inicio()
    {
        return view('suimaq_inicio');
    }

    //CALENDARIO
    public function calendario()
    {
        return view('suimaq_inicio');
    }
    
    public function calendarFeed()
    {
        $input = \Request::all(); // Expected input: start, end, in Unix timestamp format

        $incidencias_programadas = Incidencia::where('estado','Programada')
            ->where('fecha_programada','>=', date('c',$input['start'])) //date converts Unix -> ISO8601 time format
            ->where('fecha_programada','<=', date('c',$input['end']))
            ->get();

        $incidencias_cerradas = Incidencia::where('estado','Cerrada')
            ->where('fecha_programada','>=', date('c',$input['start']))
            ->where('fecha_programada','<=', date('c',$input['end']))
            ->get();

        $incidencias = array();
        foreach($incidencias_programadas as $ip) {
            if($ip->urgente) {
                $incidencias[] = [
                    'id' => $ip->id,
                    'title' => $ip->cliente()->pluck('nombre'),
                    'start' => $ip->fecha_programada->toDateTimeString(),
                    'allDay' => true,
                    'backgroundColor' => '#bc4c3c'
                ];
            } else {
                if($ip->tipo == 'Mantenimiento programado')
                    $incidencias[] = [
                        'id'    => $ip->id,
                        'title' => $ip->cliente()->pluck('nombre'),
                        'start' => $ip->fecha_programada->toDateTimeString(),
                        'allDay' => true,
                        'backgroundColor' => '#f2ce38'
                    ];
                else
                    $incidencias[] = [
                        'id'    => $ip->id,
                        'title' => $ip->cliente()->pluck('nombre'),
                        'start' => $ip->fecha_programada->toDateTimeString(),
                        'allDay' => true,
                        'backgroundColor' => '#ff9747'
                    ];
            }
        }
        foreach($incidencias_cerradas as $ic)
            $incidencias[] = [
                'id'    => $ic->id,
                'title' => $ic->cliente()->pluck('nombre'),
                'start' => $ic->fecha_programada->toDateTimeString(),
                'allDay' => true,
                'backgroundColor' => 'gray'
            ];

        return \Response::json($incidencias, 200);
    }

    public function calendarExternalFeed()
    {
        $input = \Request::all(); // Expected input: start, end, in Unix timestamp format

        $incidencias_pendientes = Incidencia::where('estado','Programable')
            ->where('fecha_prevision_programacion','>=', date('c',$input['start'])) //date converts Unix -> ISO8601 time format
            ->where('fecha_prevision_programacion','<=', date('c',$input['end']))
            ->get();

        $incidencias = array();
        foreach($incidencias_pendientes as $ip) {
            if($ip->urgente)
                $lblClass = 'label-urgente';
            elseif($ip->tipo == 'Mantenimiento programado')
                $lblClass = 'label-auto';
            else
                $lblClass = 'label-noauto';
            $incidencias[] = [
                'id'    => $ip->id,
                'title' => $ip->cliente()->pluck('nombre'),
                'allDay' => true,
                'labelClass' => $lblClass
            ];
        }

        return \Response::json($incidencias, 200);
    }

    public function fetchIncidenceDetails()
    {
        $input = \Request::all(); //id of the incidence expected
        if(!isset($input['id']) || empty($input['id']))
            return \Response::json([],404);

        $incidencia = Incidencia::find($input['id']);
        $cliente = $incidencia->cliente()->first();
        $maquina = $incidencia->maquina()->first();
        if($incidencia->tipo === 'Mantenimiento programado')
            $tipo_intervencion = $incidencia->tipo_intervencion()->first();
        $num_serie_str = '';
        if($maquina->no_serie)
            $num_serie_str .= ' ('.$maquina->no_serie.')';
        return \Response::json([
            'cliente'           => $cliente->nombre,
            'direccion'         => $cliente->direccion,
            'persona_contacto'  => $cliente->persona_contacto,
            'tlf_contacto'      => $cliente->tlf_contacto,
            'maquina'           => $maquina->marca.'/'.$maquina->modelo.$num_serie_str,
            'no_of'             => $incidencia->no_of,
            'descripcion'       => $incidencia->descripcion,
            'obs_maquina'       => $maquina->observaciones,
            'obs_cliente'       => $cliente->observaciones,
            'tipo_intervencion' => (isset($tipo_intervencion)) ? $tipo_intervencion->nombre : $incidencia->tipo,
            'desc_intervencion' => (isset($tipo_intervencion)) ? '('.$tipo_intervencion->descripcion.')' : null,
            'estado'            => $incidencia->estado,
            'fecha_prevista'    => (!is_null($incidencia->fecha_prevision_programacion) && $incidencia->fecha_prevision_programacion != '0000-00-00 00:00:00') ? date('d/m/Y', strtotime($incidencia->fecha_prevision_programacion->toDateTimeString())) : '',
            'fecha_programada'  => (!is_null($incidencia->fecha_programada) && $incidencia->fecha_programada != '0000-00-00 00:00:00') ? date('d/m/Y', strtotime($incidencia->fecha_programada->toDateTimeString())) : '',
        ],200);
    }

    public function programarIncidence()
    {
        $input = \Request::all(); //id and start date (Unix timestamp) expected
        if(!isset($input['id']) || empty($input['id']) || !isset($input['start']) || empty($input['start']))
            return \Response::json(['msg'=>'Datos insuficientes'],404);

        $incidencia = Incidencia::find($input['id']);
        if($incidencia->estado == 'Cerrada')
            return \Response::json(['title'=>'Modificación no permitida','msg'=>'No es posible modificar la fecha de programación de una incidencia cerrada.'],200);
        $incidencia->fecha_programada = $input['start'];//date('c',$input['start']);
        $incidencia->estado = 'Programada';

        if($incidencia->save()) {
            if($incidencia->tipo == 'Mantenimiento programado')
                if($this->updateDates($incidencia->maquina_id,$incidencia->id,'fecha_programada'))
                    return \Response::json(['msg' => 'Incidencia programada correctamente y fechas del patrón actualizadas.'], 200);
                else
                    return \Response::json(['msg' => 'Incidencia programada correctamente, pero con errores al actualizar las fecha de los mantenimientos del patrón.'], 200);
            return \Response::json(['msg' => 'Incidencia programada correctamente.'], 200);
        }

        return \Response::json(['msg'=>'Error al tratar de programar incidencia.'],500);
    }

    public function desprogramarIncidence()
    {
        $input = \Request::all(); //id expected
        if(!isset($input['id']) || empty($input['id']))
            return \Response::json(['msg'=>'Datos insuficientes'],404);

        $incidencia = Incidencia::find($input['id']);
        if($incidencia->estado == 'Cerrada')
            return \Response::json(['title'=>'Modificación no permitida','msg'=>'No es posible desprogramar una incidencia cerrada. Reabra la incidencia si desea desprogramarla.'],200);

        $incidencia->estado = 'Programable';
        $incidencia->fecha_programada = null;
        if($incidencia->save()) {
            if($incidencia->tipo == 'Mantenimiento programado')
                $this->updateDates($incidencia->maquina_id,$incidencia->id);

            if($incidencia->urgente)
                $lblClass = 'label-urgente';
            elseif($incidencia->tipo == 'Mantenimiento programado')
                $lblClass = 'label-auto';
            else
                $lblClass = 'label-noauto';

            return \Response::json([
                'id'    => $incidencia->id,
                'title' => $incidencia->cliente()->pluck('nombre'),
                'labelClass' => $lblClass
            ], 200);
        }

        return \Response::json(['msg'=>'Error al tratar de desprogramar incidencia.'],500);
    }

    public function toggleIncidence()
    {
        $input = \Request::all(); //id of the incidence expected
        if(!isset($input['id']) || empty($input['id']))
            return \Response::json([],404);

        $incidencia = Incidencia::find($input['id']);
        if($incidencia->urgente) $bgColor = '#bc4c3c';
        elseif($incidencia->tipo == 'Mantenimiento programado') $bgColor = '#f2ce38';
        else $bgColor = '#ff9747';

        if($incidencia->estado == 'Cerrada') {
            $incidencia->estado = 'Programada';
            if($incidencia->save())
                return \Response::json(['bgColor'=>$bgColor,'msg'=>'Incidencia reabierta.'],200);
        } elseif($incidencia->estado == 'Programada') {
            $incidencia->estado = 'Cerrada';
            if($incidencia->save())
                return \Response::json(['bgColor'=>'gray','msg'=>'Incidencia cerrada.'],200);
        } else {
            return \Response::json(['msg'=>'El estado actual de la incidencia no permite cerrar o reabrir la incidencia.'],500);
        }
        return \Response::json(['msg'=>'Error al tratar de actualizar incidencia.'],500);
    }

    //INCIDENCIAS
    public function ajustes()
    {
        return view('suimaq_ajustes');
    }

    public function oldIncidencias()
    {
        return view('suimaq_incidencias_2DEL');
    }

    public function incidencias()
    {
//        $incidencias = Incidencia::where('urgente', false)->where('estado','<>','Cerrada')->orderBy('fecha_prevision_programacion','ASC')->paginate(12);
        $incidencias = Incidencia::where('urgente', false)->where('estado','<>','Cerrada')->orderBy('fecha_prevision_programacion','ASC')->get();
        $urgentes = Incidencia::where('urgente', true)->where('estado','<>','Cerrada')->orderBy('fecha_prevision_programacion','ASC')->get();

        return view('suimaq_incidencias', compact('incidencias', 'urgentes'));
    }

    public function newMantenimiento()
    {
        return view('suimaq_new_mantenimiento');
    }

    public function incidenciasNueva()
    {
        return view('suimaq_incidencias_ficha');
    }

    public function fichaIncidencia()
    {
        $data = \Request::all();
        $incidencia = Incidencia::find($data['id']);
        $cliente = $incidencia->cliente()->first();
        $maquina = $incidencia->maquina()->first();
        $tipo_intervencion = $incidencia->tipo_intervencion()->first();

        return view('suimaq_incidencias_ficha', compact('incidencia','cliente','maquina','tipo_intervencion'));
    }

    public function fillMaquinas()
    {
        $input = \Request::all();
        $maquinas = Maquina::where('cliente_id',$input['idCliente'])->get();

        foreach($maquinas as $maquina) {
            $maquina->indice = $maquina->id;
            $maquina->texto = $maquina->marca.'/'.$maquina->modelo;
        }

        return \Response::json($maquinas->toArray(),200);
    }

    public function newIncidence()
    {
        $input = \Request::all();
        if(empty($input['no_of']))
            $estado = 'Sin OF';
        elseif(!isset($input['check_material']) || $input['check_material'] != 'on')
            $estado = 'Sin check material';
        else
            $estado = 'Programable';

        $newIncidencia = new Incidencia([
            'fecha_programada' => null,
            'fecha_prevision_programacion' => (!isset($input['fecha_prevision_programacion']) || $input['fecha_prevision_programacion'] == '') ? null : date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['fecha_prevision_programacion']))),
            'estado' => $estado,
            'tipo' => $input['tipo'],
            'descripcion' => $input['descripcion'],
            'no_of' => ($input['no_of'] == '') ? null : $input['no_of'],
            'check_material' => (!isset($input['check_material']) || $input['check_material'] != 'on') ? false : true,
            'contrato' => (!isset($input['contrato']) || $input['contrato'] != 'on') ? false : true,
            'urgente' => (!isset($input['urgente']) || $input['urgente'] != 'on') ? false : true,
            'cliente_id' => (!isset($input['cliente_id']) || $input['cliente_id'] == '') ? null : $input['cliente_id'],
            'maquina_id' => (!isset($input['maquina_id']) || $input['maquina_id'] == '') ? null : $input['maquina_id'],
            'tipo_intervenciones_id' => (!isset($input['tipo_intervencion_id']) || $input['tipo_intervencion_id'] == '') ? null : $input['tipo_intervencion_id'],
        ]);

        if($newIncidencia->save())
            \Session::flash('success', [
                'title'     => 'Nueva incidencia',
                'msg'       => 'Nueva incidencia creada satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Nueva incidencia',
                'msg'       => 'Error al tratar de crear nueva incidencia. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('/incidencias');
    }

    public function editIncidence()
    {
        $input = \Request::all();
        $incidencia = Incidencia::find($input['id']);

        $check_modified_date = ($input['fecha_prevision_programacion'] != $incidencia->fecha_prevision_programacion->format('d/m/Y')) ? true : false ;

        if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada')
        { //Caso incidencia ya programada/cerrada en calendario -> no es posible editar cliente, maquina, tipo de intervencion, #OF, ni check material
            $incidencia->descripcion = $input['descripcion'];
            $incidencia->contrato = (!isset($input['contrato']) || $input['contrato'] != 'on') ? false : true;
//            $incidencia->check_control = (!isset($input['check_control']) || $input['check_control'] != 'on') ? false : true;
        } else {
            if(empty($input['no_of']))
                $estado = 'Sin OF';
            elseif(!isset($input['check_material']) || $input['check_material'] != 'on')
                $estado = 'Sin check material';
            else
                $estado = 'Programable';

            if($incidencia->tipo == 'Mantenimiento programado')
            { //caso incidencia programada automaticamente -> no es posible editar cliente, maquina, tipo de intervencion
                $incidencia->fecha_prevision_programacion = (!isset($input['fecha_prevision_programacion']) || $input['fecha_prevision_programacion'] == '') ? null : date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['fecha_prevision_programacion'])));
                $incidencia->estado = $estado;
                $incidencia->descripcion = $input['descripcion'];
                $incidencia->no_of = ($input['no_of'] == '') ? null : $input['no_of'];
                $incidencia->check_material = (!isset($input['check_material']) || $input['check_material'] != 'on') ? false : true;
                $incidencia->contrato = (!isset($input['contrato']) || $input['contrato'] != 'on') ? false : true;
//                $incidencia->check_control = (!isset($input['check_control']) || $input['check_control'] != 'on') ? false : true;
                $incidencia->urgente = (!isset($input['urgente']) || $input['urgente'] != 'on') ? false : true;
            }
            else
            { //caso incidencia programada manualmente -> se pueden editar todos los datos
                $incidencia->fecha_prevision_programacion = (!isset($input['fecha_prevision_programacion']) || $input['fecha_prevision_programacion'] == '') ? null : date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['fecha_prevision_programacion'])));
                $incidencia->estado = $estado;
                $incidencia->descripcion = $input['descripcion'];
                $incidencia->no_of = ($input['no_of'] == '') ? null : $input['no_of'];
                $incidencia->check_material = (!isset($input['check_material']) || $input['check_material'] != 'on') ? false : true;
                $incidencia->contrato = (!isset($input['contrato']) || $input['contrato'] != 'on') ? false : true;
//                $incidencia->check_control = (!isset($input['check_control']) || $input['check_control'] != 'on') ? false : true;
                $incidencia->urgente = (!isset($input['urgente']) || $input['urgente'] != 'on') ? false : true;
                $incidencia->cliente_id = (!isset($input['cliente_id']) || $input['cliente_id'] == '') ? null : $input['cliente_id'];
                $incidencia->maquina_id = (!isset($input['maquina_id']) || $input['maquina_id'] == '') ? null : $input['maquina_id'];
                $incidencia->tipo_intervenciones_id = (!isset($input['tipo_intervencion_id']) || $input['tipo_intervencion_id'] == '') ? null : $input['tipo_intervencion_id'];
            }
        }

        if($incidencia->save()) {
            if ($incidencia->tipo == 'Mantenimiento programado' && $check_modified_date) {
                if ($this->updateDates($incidencia->maquina_id, $incidencia->id))
                    \Session::flash('warning', [
                        'title' => 'Se actualizaron fechas del patrón',
                        'msg' => 'Se han actualizado las fechas de previsión de programación de las incidencias posteriores a la modificada.'
                    ]);
                else
                    \Session::flash('error', [
                        'title' => 'Error al tratar de actualizar fechas del patrón',
                        'msg' => 'Se ha obtenido un error al tratar de actualizar las fechas de previsión de programación de las incidencias posteriores a la modificada.'
                    ]);
            }
            \Session::flash('success', [
                'title' => 'Editar incidencia',
                'msg' => 'Los datos de la incidencia han sido actualizados satisfactoriamente'
            ]);
        } else {
            \Session::flash('error', [
                'title' => 'Editar incidencia',
                'msg' => 'Error al tratar de actualizar datos de la incidencia. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);
        }

        return redirect('/incidencias');
    }

    public function updateOF()
    {
        $input = \Request::all();
        $incidencia = Incidencia::find($input['pk']);

        if(!empty($input['value'])) {
            $incidencia->no_of = $input['value'];
            if($incidencia->estado != 'Programada' && $incidencia->estado != 'Cerrada')
                if ($incidencia->check_material == 1)
                    $incidencia->estado = 'Programable';
                else
                    $incidencia->estado = 'Sin check material';
            if($incidencia->save())
                return \Response::json(['idIncidencia'=>$input['pk'],'newEstado'=>$incidencia->estado,'title'=>'Incidencia actualizada','success'=>'El #OF de la incidencia fue actualizado satisfactoriamente.'],200);
        } else {
            if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada')
                return \Response::json(['idIncidencia'=>$input['pk'],'oldValue'=>$input['value'],'title'=>'Acción no permitida','error'=>'No es posible dejar en blanco el #OF de una incidencia ya programada. Desprograme la incidencia previamente si desea borrar el #OF.'],200);
            $incidencia->no_of = $input['value'];
            $incidencia->estado = 'Sin OF';
            if($incidencia->save())
                return \Response::json(['idIncidencia'=>$input['pk'],'newEstado'=>'Sin OF','title'=>'#OF no especificado','warning'=>'No se ha especificado #OF. El estado de la incidencia se ha actualizado a "Sin OF".'],200);
        }
        return \Response::json(['idIncidencia'=>$input['pk'],'oldValue'=>$input['value'],'title'=>'Error al actualizar #OF','error'=>'Error al tratar de actualizar el #OF de la incidencia. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'],200);
    }

    public function updateMaterial()
    {
        $input = \Request::all();
        $incidencia = Incidencia::find($input['pk']);

        if($incidencia->estado == 'Programada' || $incidencia->estado == 'Cerrada')
            return \Response::json([
                'idIncidencia'=>$input['pk'],
                'title'=>'Acción no permitida',
                'error'=>'No es posible cambiar el estado check material de una incidencia ya programada. Desprograme la incidencia previamente si desea actualizar el estado del check material.'
            ],200);

        if($input['material'] == 'true') {
            $incidencia->check_material = true;
            if($incidencia->estado == 'Sin check material')
                $incidencia->estado = 'Programable';
        } else {
            $incidencia->check_material = false;
            if($incidencia->estado == 'Programable')
                $incidencia->estado = 'Sin check material';
            //else: si la incidencia está en estado Sin OF, permanece en el mismo estado
        }

        if($incidencia->save())
            return \Response::json([
                'idIncidencia'=>$input['pk'],
                'newEstado'=>$incidencia->estado,
                'title'=>'Incidencia actualizada',
                'success'=>'El estado check material de la incidencia fue actualizado satisfactoriamente.'
            ],200);
        return \Response::json([
            'idIncidencia'=>$input['pk'],
            'title'=>'Error al actualizar check material',
            'error'=>'Error al tratar de actualizar el estado check material de la incidencia. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
        ],200);

    }

    //CLIENTES
    public function clientes()
    {
        $clientes = Cliente::paginate(25);
        foreach($clientes as $c)
            $c->no_maquinas = Maquina::where('cliente_id',$c->id)->count();

        return view('suimaq_clientes', compact('clientes'));
    }

    public function clientesNuevo()
    {
        return view('suimaq_clientes_ficha');
    }

    public function clientesDetalle()
    {
        return view('suimaq_clientes_detalle');
    }

    public function newCliente()
    {
        return view('suimaq_new_cliente');
    }

    public function searchCustomerByName()
    {
        $input = \Request::all();
        $searchStr = $input['searchStr'];
        $searchStr = ltrim($searchStr);
        if($searchStr=='') {
            $clientes = Cliente::paginate(25);
        } else {
            $searchArray = explode(' ', $searchStr);
            $wordsStr = '';
            foreach ($searchArray as $word)
                if ($word != "")
                    $wordsStr .= "+" . $word . "* ";
            $clientes = \DB::table('clientes')
                ->whereNull('deleted_at')
                ->whereRaw("MATCH(`nombre`) AGAINST(? IN BOOLEAN MODE)", array($wordsStr))
                ->orderBy('id', 'ASC')
                ->paginate(25);
        }
        foreach($clientes as $c)
            $c->no_maquinas = Maquina::where('cliente_id',$c->id)->count();

        return view('suimaq_clientes', compact('clientes'));
    }

    public function newCustomer()
    {
        $input = \Request::all();
        $vip = (isset($input['vip']) && $input['vip']==='on') ? true : false;
        $cliente = new Cliente($input);
        $cliente->vip = $vip;

        if($cliente->save())
            \Session::flash('success', [
                'title'     => 'Nuevo cliente',
                'msg'       => 'El cliente '.$input['nombre'].' ha sido dado de alta satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Nuevo cliente',
                'msg'       => 'Error al tratar de guardar nuevo cliente en base de datos. Si el problema persiste, póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('/clientes');
    }

    public function editCustomer()
    {
        $input = \Request::all();
        $cliente = Cliente::find($input['id']);
        $cliente->vip = (isset($input['vip']) && $input['vip']==='on') ? true : false;
        $cliente->nombre = $input['nombre'];
        $cliente->persona_contacto =  $input['persona_contacto'];
        $cliente->tlf_contacto =  $input['tlf_contacto'];
        $cliente->direccion =  $input['direccion'];
        $cliente->observaciones = $input['observaciones'];

        if($cliente->save())
            \Session::flash('success', [
                'title'     => 'Editar cliente',
                'msg'       => 'Datos de '.$input['nombre'].' actualizados satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Editar cliente',
                'msg'       => 'Error al tratar de actualizar los datos del cliente. Si el problema persiste, póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('/clientes');
    }

    public function deleteCustomer()
    {
        $input = \Request::all();
        $check = array();
        $check[] = Incidencia::where('cliente_id',$input['id'])->delete();
        $check[] = Maquina::where('cliente_id',$input['id'])->delete();
        $check[] = Cliente::find($input['id'])->delete();

        return \Response::json($check,200);
    }

    public function fichaCliente()
    {
        $input = \Request::all();
        $cliente = Cliente::find($input['id']);

        return view('suimaq_clientes_ficha',compact('cliente'));
    }

    public function clientesHistorial()
    {
        $data = \Request::all();
        $cliente = Cliente::find($data['id']);
        $incidencias = Incidencia::where('cliente_id',$data['id'])->paginate(25);
        return view('suimaq_clientes_historial',compact('cliente','incidencias'));
    }

    //MÁQUINAS
    public function maquinasDetalle()
    {
        return view('suimaq_maquinas_detalle');
    }

    public function maquinasHistorial()
    {
        $data = \Request::all();
        $maquina = Maquina::find($data['id']);
        $cliente = $maquina->cliente()->first();
        $incidencias = Incidencia::where('maquina_id',$data['id'])->paginate(25);
        return view('suimaq_maquinas_historial', compact('maquina','cliente','incidencias'));
    }

    public function newMachine()
    {
        $input = \Request::all();
        $input['puesta_en_marcha'] = ((!isset($input['puesta_en_marcha'])) || ($input['puesta_en_marcha'] == '')) ? null : date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['puesta_en_marcha'])));
        $input['patrones_id'] = ($input['patrones_id'] == '') ? null : $input['patrones_id'];
        $input['pos_intervencion_inicial'] = ((!isset($input['pos_intervencion_inicial'])) || ($input['pos_intervencion_inicial'] == '')) ? null : $input['pos_intervencion_inicial'];
        $maquina = new Maquina($input);
        $cliente = Cliente::find($input['cliente']);
        $maquina->cliente()->associate($cliente);
        if(\Input::hasFile('doc')) {
            $file = \Input::file('doc');
            $filename = Carbon::now()->format('YmdHis_') . \Input::file('doc')->getClientOriginalName();
            $path = public_path().'/docs/';
            $file->move($path, $filename);
            $maquina->doc = $filename;
        } else {
            $maquina->doc = 'Manual_no_disponible.txt';
        }

        if($maquina->save())
            \Session::flash('success', [
                'title'     => 'Nueva máquina',
                'msg'       => 'La nueva máquina ha sido dado de alta satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Nuevo máquina',
                'msg'       => 'Error al tratar de guardar nueva máquina en base de datos. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        //crear piezas
        if($maquina->id && !is_null($input['patrones_id'])) {
            foreach ($input as $key => $value) {
                if (strpos($key, 'posicion_') === 0)
                    $newPieza = new Pieza();
                elseif (strpos($key, 'nombre_') === 0)
                    $newPieza->nombre = $value;
                elseif (strpos($key, 'referencia_') === 0)
                    $newPieza->referencia = $value;
                elseif (strpos($key, 'cantidad_') === 0)
                    $newPieza->cantidad = $value;
                elseif (strpos($key, 'tipo-intervencion_') === 0) {
                    $newPieza->tipo_intervenciones_id = $value;
                    $newPieza->maquina_id = $maquina->id;
                    $newPieza->save();
                }
            }
        }

        //crear incidencias a partir del patrón de intervenciones de la máquina si tenemos todos los datos necesarios
        if(!is_null($input['puesta_en_marcha']) && !is_null($input['patrones_id']) && !is_null($input['pos_intervencion_inicial']) && $input['no_revisiones_anuales'] != '') {
            if ($this->updateIncidencias($maquina->id))
                \Session::flash('warning', [
                    'title' => 'Nuevos mantenimientos programados',
                    'msg' => 'Se han generado mantenimientos a partir del patrón de intervenciones asociado a la nueva máquina'
                ]);
        } else {
            \Session::flash('warning', [
                'title' => 'Máquina sin patrón de mantenimientos',
                'msg' => 'No se ha asignado patrón de mantenimientos o no se han aportado datos suficientes para generar mantenimientos programados.'
            ]);
        }

        return redirect('/clientes/maquinas?id='.$input['cliente']);
    }

    public function editMachine()
    {
        $input = \Request::all();

        $maquina = Maquina::find($input['id']);

        //volver a crear piezas asociadas (eliminar previas)
        $maquina->piezas()->delete();
        if($maquina->id && !is_null($input['patrones_id'])) {
            foreach ($input as $key => $value) {
                if (strpos($key, 'posicion_') === 0)
                    $newPieza = new Pieza();
                elseif (strpos($key, 'nombre_') === 0)
                    $newPieza->nombre = $value;
                elseif (strpos($key, 'referencia_') === 0)
                    $newPieza->referencia = $value;
                elseif (strpos($key, 'cantidad_') === 0)
                    $newPieza->cantidad = $value;
                elseif (strpos($key, 'tipo-intervencion_') === 0) {
                    $newPieza->tipo_intervenciones_id = $value;
                    $newPieza->maquina_id = $maquina->id;
                    $newPieza->save();
                }
            }
        }

        //store old values in case we need to revert the values of the step sequence related variables
        $saved_old_fecha = $maquina->puesta_en_marcha;
        if($saved_old_fecha)
            $check_new_fecha = ($input['puesta_en_marcha'] != $saved_old_fecha->format('d/m/Y')) ? true : false;
        else
            $check_new_fecha = ($input['puesta_en_marcha'] != '') ? true : false;

        $input['puesta_en_marcha'] = ((!isset($input['puesta_en_marcha'])) || ($input['puesta_en_marcha'] == '')) ? null : date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['puesta_en_marcha'])));
        $input['patrones_id'] = ($input['patrones_id'] == '') ? null : $input['patrones_id'];
        $input['pos_intervencion_inicial'] = ((!isset($input['pos_intervencion_inicial'])) || ($input['pos_intervencion_inicial'] == '')) ? null : $input['pos_intervencion_inicial'];

        //in case we need to revert changes
        $saved_old_pattern = $maquina->patrones_id;
        $saved_old_rev_anuales = $maquina->no_revisiones_anuales;
        $saved_old_position = $maquina->pos_intervencion_inicial;

        $check_new_pattern = ($input['patrones_id'] != $saved_old_pattern) ? true : false;
        $check_new_rev_anuales = ($input['no_revisiones_anuales'] != $saved_old_rev_anuales) ? true : false;
        $check_new_position = ($input['pos_intervencion_inicial'] != $saved_old_position) ? true : false;

        $maquina->puesta_en_marcha = $input['puesta_en_marcha'];
        $maquina->no_revisiones_anuales = $input['no_revisiones_anuales'];
        $maquina->patrones_id = $input['patrones_id'];
        $maquina->pos_intervencion_inicial = $input['pos_intervencion_inicial'];

        $maquina->marca = $input['marca'];
        $maquina->modelo = $input['modelo'];
        $maquina->no_serie = $input['no_serie'];
        $maquina->horas_funcionamiento = $input['horas_funcionamiento'];
//        $maquina->localizacion = $input['localizacion'];
        $maquina->observaciones = $input['observaciones'];
        if(\Input::hasFile('doc'))
        {
            $file = \Input::file('doc');
            $file_extension =
            $filename = Carbon::now()->format('YmdHis_').
                \Input::file('doc')->getClientOriginalName();
            $path = public_path().'/docs/';
            $file->move($path, $filename);
            $maquina->doc = $filename;
        } else {
            $maquina->doc = 'Manual_no_disponible.txt';
        }

        if($maquina->save())
            \Session::flash('success', [
                'title'     => 'Editar máquina',
                'msg'       => 'Los datos de la máquina han sido actualizados satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Editar máquina',
                'msg'       => 'Error al tratar de actualizar los datos de la máquina. Si el problema persiste, póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        //re-crear incidencias a partir del patrón de intervenciones de la máquina si tenemos todos los datos necesarios
        if($check_new_fecha || $check_new_pattern || $check_new_position || $check_new_rev_anuales) {
            if(!is_null($input['puesta_en_marcha']) && !is_null($input['patrones_id']) && !is_null($input['pos_intervencion_inicial']) && $input['no_revisiones_anuales'] != '') {
                if($this->updateIncidencias($maquina->id, true))
                    \Session::flash('warning', [
                        'title'     => 'Modificación de mantenimientos programados',
                        'msg'       => 'Se han modificado los mantenimientos a partir del nuevo patrón de intervenciones asociado a la máquina.'
                    ]);
            } else { //revert changes
                $maquina->puesta_en_marcha = $saved_old_fecha;
                $maquina->no_revisiones_anuales = $saved_old_rev_anuales;
                $maquina->patrones_id = $saved_old_pattern;
                $maquina->pos_intervencion_inicial = $saved_old_position;
                $maquina->save();
                \Session::flash('warning', [
                    'title' => 'No se pudo modificar patrón de mantenimientos',
                    'msg' => 'No se han aportado datos suficientes para generar un nuevo patrón de mantenimientos. Se mantendrá la configuración anterior.'
                ]);
            }
        }

        return redirect('/clientes/maquinas?id='.$input['cliente']);
    }

    public function deleteMachine()
    {
        $input = \Request::all();
        $check = array();
        $check[] = Incidencia::where('maquina_id',$input['id'])->delete();
        $check[] = Maquina::find($input['id'])->delete();

        return \Response::json($check,200);
    }

    public function maquinasNueva()
    {
        $data = \Request::all();
        $cliente = Cliente::find($data['cliente']);

        return view('suimaq_maquinas_ficha',compact('cliente'));
    }

    public function fichaMaquina()
    {
        $data = \Request::all();
        $maquina = Maquina::find($data['id']);
        $cliente = $maquina->cliente()->first();

        return view('suimaq_maquinas_ficha',compact('cliente','maquina'));
    }

    public function maquinas()
    {
        $data = \Request::all();
        $cliente = Cliente::find($data['id']);
        $maquinas = Maquina::where('cliente_id',$data['id'])->paginate(25);
        foreach($maquinas as $m)
            if($m->patrones_id)
                $m->secuencia = SecuenciaStep::where('patrones_id',$m->patrones_id)->orderBy('posicion','ASC')->get();

        return view('suimaq_maquinas',compact('cliente','maquinas'));
    }

    public function searchMaquinas()
    {
        $input = \Request::all();
        $cliente = Cliente::find($input['idCliente']);

        if($input['strMarca']=='' && $input['strModelo']=='' && $input['strNoSerie']=='') {
            $maquinas = Maquina::where('cliente_id',$input['idCliente'])->paginate(25);
        } else {
            $cliente = Cliente::find($input['idCliente']);
            $strMarca = ltrim($input['strMarca']);
            $strModelo = ltrim($input['strModelo']);
            $strNoSerie = ltrim($input['strNoSerie']);
            $arr1 = explode(' ', $strMarca);
            $arr2 = explode(' ', $strModelo);
            $arr3 = explode(' ', $strNoSerie);
            $str1 = '';
            $str2 = '';
            $str3 = '';
            foreach ($arr1 as $word)
                if ($word != "")
                    $str1 .= "+" . $word . "* ";
            foreach ($arr2 as $word)
                if ($word != "")
                    $str2 .= "+" . $word . "* ";
            foreach ($arr3 as $word)
                if ($word != "")
                    $str3 .= "+" . $word . "* ";
            $check1 = ($str1=='') ? false : true;
            $check2 = ($str2=='') ? false : true;
            $check3 = ($str3=='') ? false : true;

            if($check1 && $check2 && $check3)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`marca`) AGAINST(? IN BOOLEAN MODE)", array($str1))
                    ->whereRaw("MATCH(`modelo`) AGAINST(? IN BOOLEAN MODE)", array($str2))
                    ->whereRaw("MATCH(`no_serie`) AGAINST(? IN BOOLEAN MODE)", array($str3))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check1 && $check2)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`marca`) AGAINST(? IN BOOLEAN MODE)", array($str1))
                    ->whereRaw("MATCH(`modelo`) AGAINST(? IN BOOLEAN MODE)", array($str2))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check1 && $check3)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`marca`) AGAINST(? IN BOOLEAN MODE)", array($str1))
                    ->whereRaw("MATCH(`no_serie`) AGAINST(? IN BOOLEAN MODE)", array($str3))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check2 && $check3)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`modelo`) AGAINST(? IN BOOLEAN MODE)", array($str2))
                    ->whereRaw("MATCH(`no_serie`) AGAINST(? IN BOOLEAN MODE)", array($str3))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check1)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`marca`) AGAINST(? IN BOOLEAN MODE)", array($str1))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check2)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`modelo`) AGAINST(? IN BOOLEAN MODE)", array($str2))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            elseif($check3)
                $maquinas = \DB::table('maquinas')
                    ->whereNull('deleted_at')
                    ->where('cliente_id',$input['idCliente'])
                    ->whereRaw("MATCH(`no_serie`) AGAINST(? IN BOOLEAN MODE)", array($str3))
                    ->orderBy('id', 'ASC')
                    ->paginate(25);
            else
                $maquinas = Maquina::where('cliente_id',$input['idCliente'])->paginate(25);
        }

        foreach($maquinas as $m)
            $m->secuencia = SecuenciaStep::where('patrones_id',$m->patrones_id)->orderBy('posicion','ASC')->get();

        return view('suimaq_maquinas',compact('cliente','maquinas'));
    }

    public function fillSteps()
    {
        $input = \Request::all();

        $steps = SecuenciaStep::withTrashed()
            ->where('patrones_id',$input['idPatron'])
            ->orderBy('posicion','ASC')
            ->get();

        foreach($steps as $step)
            $step->texto = TipoIntervencion::withTrashed()->where('id',$step->tipo_intervenciones_id)->pluck('nombre');

        return \Response::json($steps->toArray(),200);
    }

    //PIEZAS
    public function piezas()
    {
        $input = \Request::all();
        $maquina = Maquina::find($input['id']);
        $cliente = $maquina->cliente()->first();
        $piezas = $maquina->piezas()->get();

        return view('suimaq_piezas',compact('cliente','maquina','piezas'));
    }

    public function piezaNueva()
    {
        $input = \Request::all();
        $maquina = Maquina::find($input['maquina']);
        $cliente = $maquina->cliente()->first();

        return view('suimaq_piezas_ficha',compact('cliente','maquina'));
    }

    public function fichaPieza()
    {
        $input = \Request::all();
        $pieza = Pieza::find($input['id']);
        $maquina = $pieza->maquina()->first();
        $cliente = $maquina->cliente()->first();

        return view('suimaq_piezas_ficha',compact('cliente','maquina','pieza'));
    }

    public function newPieza()
    {
        $input = \Request::all();
        $newPieza = new Pieza($input);
        if($newPieza->save())
            \Session::flash('success', [
                'title'     => 'Nueva pieza',
                'msg'       => 'La nueva pieza ha sido dada de alta satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Nueva pieza',
                'msg'       => 'Error al tratar de guardar nueva pieza en base de datos. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('/clientes/maquinas/piezas?id='.$input['maquina_id']);
    }

    public function editPieza()
    {
        $input = \Request::all();
        $pieza = Pieza::find($input['id']);
        $pieza->nombre = $input['nombre'];
        $pieza->referencia = $input['referencia'];
        $pieza->cantidad = $input['cantidad'];
        $pieza->tipo_intervenciones_id = $input['tipo_intervenciones_id'];
        if($pieza->save())
            \Session::flash('success', [
                'title'     => 'Editar pieza',
                'msg'       => 'Datos de la pieza actualizados con éxito'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Editar pieza',
                'msg'       => 'Error al tratar de actualizar los datos de la pieza. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('/clientes/maquinas/piezas?id='.$input['maquina_id']);
    }

    public function deletePieza()
    {
        $input = \Request::all();
        $check = array();
        $check[] = Pieza::find($input['id'])->delete();

        return \Response::json($check,200);
    }

    //INTERVENCIONES
    public function intervenciones()
    {
        $tipos_de_intervencion = TipoIntervencion::orderBy('nombre','ASC')->get();
        $patrones = PatronIncidencias::all();
        return view('suimaq_intervenciones', compact('tipos_de_intervencion','patrones'));
    }

    public function patronesNuevo()
    {
        $tipos = TipoIntervencion::orderBy('nombre','ASC')->get();

        return view('suimaq_patrones_ficha', compact('tipos'));
    }

    public function tiposNuevo()
    {
        return view('suimaq_intervenciones_ficha');
    }

    public function newType()
    {
        $input = \Request::all();
        $newType = new TipoIntervencion($input);
        if($newType->save())
            \Session::flash('success', [
                'title'     => 'Nuevo tipo de intervención',
                'msg'       => 'El nuevo tipo de intervención ha sido dado de alta satisfactoriamente'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Nuevo tipo de intervención',
                'msg'       => 'Error al tratar de guardar nuevo tipo de intervención en base de datos. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('intervenciones');
    }

    public function editType()
    {
        $input = \Request::all();
        $type = TipoIntervencion::find($input['id']);
        $type->nombre = $input['nombre'];
        $type->descripcion = $input['descripcion'];
        if($type->save())
            \Session::flash('success', [
                'title'     => 'Editar tipo de intervención',
                'msg'       => 'Datos del tipo de intervención actualizados con éxito'
            ]);
        else
            \Session::flash('error', [
                'title'     => 'Editar tipo de intervención',
                'msg'       => 'Error al tratar de actualizar los datos del tipo de intervención. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('intervenciones');
    }

    public function newPattern()
    {
        $input = \Request::all();
        $newPattern = new PatronIncidencias($input);
        if($newPattern->save()) {
            foreach ($input as $key => $value) {
                if(strpos($key, 'posicion_') === 0) {
                    $newStep = new SecuenciaStep();
                    $newStep->posicion = $value;
                    $newStep->patrones_id = $newPattern->id;
                }
//                elseif(strpos($key, 'periodo_') === 0) {
//                    $newStep->periodo = $value;
//                }
                elseif(strpos($key, 'tipo_') === 0) {
                    $newStep->tipo_intervenciones_id = $value;
                    $newStep->save();
                }
            }
            \Session::flash('success', [
                'title' => 'Nuevo patrón de intervenciones',
                'msg' => 'El nuevo patrón de intervenciones ha sido dado de alta satisfactoriamente'
            ]);
        } else
            \Session::flash('error', [
                'title'     => 'Nuevo patrón de intervenciones',
                'msg'       => 'Error al tratar de guardar nuevo patrón de intervención en base de datos. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('intervenciones');
    }

    public function editPattern()
    {
        $input = \Request::all();
        $pattern = PatronIncidencias::find($input['id']);
        $pattern->nombre = $input['nombre'];
        if($pattern->save()) {
            SecuenciaStep::where('patrones_id',$input['id'])->forceDelete();
            foreach ($input as $key => $value) {
                if(strpos($key, 'posicion_') === 0) {
                    $newStep = new SecuenciaStep();
                    $newStep->posicion = $value;
                    $newStep->patrones_id = $input['id'];
                }
//                elseif(strpos($key, 'periodo_') === 0) {
//                    $newStep->periodo = $value;
//                }
                elseif(strpos($key, 'tipo_') === 0) {
                    $newStep->tipo_intervenciones_id = $value;
                    $newStep->save();
                }
            }
            \Session::flash('success', [
                'title' => 'Editar patrón de incidencias',
                'msg' => 'Datos del patrón de incidencias actualizados con éxito'
            ]);
        }
        else
            \Session::flash('error', [
                'title'     => 'Editar patrón de incidencias',
                'msg'       => 'Error al tratar de actualizar los datos del patrón de incidencias. Si el problema persiste póngase en contacto con el servicio técnico de la aplicación.'
            ]);

        return redirect('intervenciones');
    }

    public function deletePattern()
    {
        $input = \Request::all();
        $check = array();
//        $check[] = SecuenciaStep::where('patrones_id',$input['id'])->delete();
        $check[] = PatronIncidencias::find($input['id'])->delete();

        return \Response::json($check,200);
    }

    public function deleteType()
    {
        $input = \Request::all();
        $check = array();
//        $check[] = SecuenciaStep::where('tipo_intervenciones_id',$input['id'])->delete();
        $check[] = TipoIntervencion::find($input['id'])->delete();

        return \Response::json($check,200);
    }

    public function patronesEditar()
    {
        $data = \Request::all();
        $patron = PatronIncidencias::find($data['id']);
        $steps = SecuenciaStep::where('patrones_id',$data['id'])->orderBy('posicion','ASC')->get();
        $tipos = TipoIntervencion::withTrashed()->orderBy('nombre','ASC')->get();

        return view('suimaq_patrones_ficha', compact('patron','tipos','steps'));
    }

    public function tiposEditar()
    {
        $data = \Request::all();
        $tipo = TipoIntervencion::find($data['id']);

        return view('suimaq_intervenciones_ficha', compact('tipo'));
    }

    //OTROS

}
