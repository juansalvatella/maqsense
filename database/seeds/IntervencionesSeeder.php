<?php

use Illuminate\Database\Seeder;

class IntervencionesSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        foreach(range('A','Z') as $letter)
        {
            \App\TipoIntervencion::create([
                'nombre' => $letter,
                'descripcion' => $faker->sentence(3),
            ]);
        }

        for($i=1;$i<11;++$i)
        {
            \App\PatronIncidencias::create([
               'nombre' => $faker->sentence(2),
            ]);
        }

        $patrones = \App\PatronIncidencias::all();
        foreach($patrones as $patron)
        {
            $n_steps = mt_rand(1,5);
            for($i=0;$i<$n_steps;++$i)
            {
                $abc = range('A','Z');
                $key = mt_rand(0,count($abc)-1);
                $letter = $abc[$key];
                $tipo_intervencion = \App\TipoIntervencion::where('nombre',$letter)->first();
                \App\SecuenciaStep::create([
                    'posicion' => $i+1,
                    'periodo'  => null,
                    'tipo_intervenciones_id' => $tipo_intervencion->id,
                    'patrones_id' => $patron->id
                ]);
            }
        }

    }

}