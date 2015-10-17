<?php

use Illuminate\Database\Seeder;

class MaquinasSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        $clientes = \App\Cliente::all();
        $n_patrones = count(\App\PatronIncidencias::all());
        foreach($clientes as $c) {
            for ($i=0; $i<mt_rand(1,4); $i++) {
                $patron_id = mt_rand(1,$n_patrones);
                $revisiones = $faker->numberBetween(1, 24);
                $maquina = \App\Maquina::create([
                    'marca' => $faker->company,
                    'puesta_en_marcha' => $faker->dateTimeBetween('now', '+12 months'),
                    'modelo' => strtoupper($faker->bothify('??##')),
                    'doc' => $faker->word.'.'.$faker->fileExtension,
                    'no_serie' => $faker->randomNumber(8),
                    'horas_funcionamiento' => $faker->numberBetween(1, 8760),
                    'no_revisiones_anuales' => $revisiones,
//                    'localizacion' => $faker->address,
                    'observaciones' => $faker->paragraph(),
                    'cliente_id' => $c->id,
                    'patrones_id' => $patron_id,
                ]);

                $steps_modelo = \App\SecuenciaStep::where('patrones_id',$patron_id)->orderBy('posicion','ASC')->get();
                $periodo = (int) 365/$revisiones; // periodo en días hasta próxima intervención

                //de cara a futuro se elabora un modelo de steps por cada máquina, debido a que quizá se querrá asociar
                //un periodo distinto a cada step según los detalles de la máquina
                foreach($steps_modelo as $step)
                {
                    \App\SecuenciaStep::create([
                        'posicion' => $step->posicion,
                        'periodo'  => $periodo,
                        'tipo_intervenciones_id' => $step->tipo_intervenciones_id,
                        'patrones_id' => null, //IMPORTANTE! esto distingue el modelo de steps prototipo (asociado a un patrón) del asociado a una máquina (con detalles como el periodo de los steps)
                        'maquina_id' => $maquina->id
                    ]);
                }

                $posicion_random = mt_rand(1,count($steps_modelo));
                $maquina->pos_intervencion_inicial = $posicion_random;
                $maquina->save();

                $first_is_last = ($posicion_random == count($steps_modelo)) ? true : false;

                // Incidencias a partir de los patrones asociados a cada máquina (mantenimientos programados)
                // Seeder genera incidencias en estado Programable, pero Suimaq las ha de generar en estado Sin OF
                // A modo de test generamos sólo dos incidencias por patrón (normalmente se generan las necesarias a un año vista)
                $done_first = false;
                $done_second = false;
                for($i=0;$i<2;++$i) { //two loops - two incidences: creamos sólo dos a modo de prueba
                    foreach ($steps_modelo as $step) {
                        if (!$done_first && $step->posicion == $posicion_random) {
                            //first step
                            \App\Incidencia::create([
                                'fecha_programada' => null,
                                'fecha_prevision_programacion' => $maquina->puesta_en_marcha,
                                'estado' => 'Programable',
                                'tipo' => 'Mantenimiento programado',
                                'step_posicion' => $step->posicion,
                                'seguimiento' => 0,
                                'descripcion' => $faker->paragraph(),
                                'no_of' => $faker->randomNumber(4),
                                'check_material' => true,
                                'contrato' => $faker->boolean(50),
                                'urgente' => false,
                                'cliente_id' => $maquina->cliente()->pluck('id'),
                                'maquina_id' => $maquina->id,
                                'tipo_intervenciones_id' => $step->tipo_intervenciones_id
                            ]);
                            $done_first = true;
                        } elseif (!$done_second && (($step->posicion == 1 && $first_is_last) || ($step->posicion == $posicion_random + 1))) {
                            //second step
                            \App\Incidencia::create([
                                'fecha_programada' => null,
                                'fecha_prevision_programacion' => $maquina->puesta_en_marcha->addDays($periodo),
                                'estado' => 'Programable',
                                'tipo' => 'Mantenimiento programado',
                                'step_posicion' => $step->posicion,
                                'seguimiento' => 1,
                                'descripcion' => $faker->paragraph(),
                                'no_of' => $faker->randomNumber(4),
                                'check_material' => true,
                                'contrato' => $faker->boolean(50),
                                'urgente' => false,
                                'cliente_id' => $maquina->cliente()->pluck('id'),
                                'maquina_id' => $maquina->id,
                                'tipo_intervenciones_id' => $step->tipo_intervenciones_id
                            ]);
                            $done_second = true;
                        }
                    }
                }
            }
        }
    }

}