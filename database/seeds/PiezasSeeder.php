<?php

use Illuminate\Database\Seeder;

class PiezasSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        foreach(\App\Maquina::all() as $maquina)
            foreach($maquina->steps()->groupBy('tipo_intervenciones_id')->get() as $step)
                for($i=0;$i<mt_rand(1,4);++$i) //generar de 1 a 4 piezas por tipo de intervencion
                    \App\Pieza::create([
                        'nombre' => $faker->randomElement(['tornillo','tuerca','compás','regla','cable','manguito','goma','plástico']),
                        'referencia' => strtoupper($faker->bothify('???##')),
                        'cantidad' => mt_rand(1,12),
                        'maquina_id' => $maquina->id,
                        'tipo_intervenciones_id' => $step->tipo_intervenciones_id,
                    ]);
    }
}