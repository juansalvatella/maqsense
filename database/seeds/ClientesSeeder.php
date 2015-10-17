<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClientesSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        for ($i=0; $i<10; $i++) {
            $newCliente = Cliente::create(array(
                'vip' => $faker->boolean(20),
                'nombre' => $faker->company,
                'persona_contacto' => $faker->name,
                'tlf_contacto' => $faker->phoneNumber,
                'direccion' => $faker->address,
                'observaciones' => $faker->paragraph(),
            ));
        }
    }
}
