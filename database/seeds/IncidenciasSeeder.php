<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Maquina;
use App\Incidencia;

class IncidenciasSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        $clientes = Cliente::all();
        foreach($clientes as $cliente) {
            foreach($cliente->maquinas()->get() as $m) {
                // Incidencias que no forman parte de ningún patrón (mantenimiento no programado)
                // A modo de test creamos una incidencia no programada por cada máquina
                // con distintos tipos de estados y fechas de programación
                $f_prevista = $faker->dateTimeBetween('-1 month','1 year');
                if($f_prevista > \Carbon\Carbon::now()) {
                    $estado = $faker->randomElement(['Programada','Programable','Sin OF','Sin check material']);
                    if($estado == 'Programada')
                        $f_programacion = $f_prevista;
                    else
                        $f_programacion = null;
                    if($estado == 'Sin OF')
                        $no_of = null;
                    else
                        $no_of = $faker->randomNumber(4);
                    if($estado == 'Sin check material' || $estado == 'Sin OF')
                        $material = false;
                    else
                        $material = true;
                } else {
                    $estado = 'Cerrada';
                    $no_of = $faker->randomNumber(4);
                    $material = true;
                    $f_programacion = $f_prevista;
                }
                Incidencia::create([
                    'fecha_programada' => $f_programacion,
                    'fecha_prevision_programacion' => $f_prevista,
                    'estado' => $estado,
                    'tipo' => 'Mantenimiento no programado',
                    'step_posicion' => null,
                    'descripcion' => $faker->paragraph(),
                    'no_of' => $no_of,
                    'check_material' => $material,
                    'contrato' => $faker->boolean(50),
                    'urgente' => $faker->boolean(30),
                    'cliente_id' => $cliente->id,
                    'maquina_id' => $m->id,
                    'tipo_intervenciones_id' => \App\TipoIntervencion::orderByRaw("RAND()")->take(1)->pluck('id'),
                ]);
            }
        }
    }
}