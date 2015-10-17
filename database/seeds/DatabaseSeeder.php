<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \Caffeinated\Shinobi\Models\Permission;
use \Caffeinated\Shinobi\Models\Role;
use  App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        //Permissions
        $permRead = Permission::create([
            'name' => 'Read',
            'slug' => 'read',
            'description' => 'El usuario tiene acceso a todas las páginas pero no puede crear nuevos datos ni modificar los existentes.'
        ]);
        $permWrite = Permission::create([
            'name' => 'Write',
            'slug' => 'write',
            'description' => 'El usuario tiene acceso a todas las páginas y puede crear y modificar datos.'
        ]);
        $this->command->info('Basic permissions created.');

        //Roles
        $roleUser = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Usuario de Suimaq con acceso de lectura a todas las páginas.'
        ]);
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Usuario de Suimaq con acceso de lectura a todas las páginas, modificación y creación de datos.'
        ]);
        $this->command->info('Basic roles created.');

        $roleUser->assignPermission($permRead->id);
        $roleUser->save();
        $roleAdmin->assignPermission($permRead->id);
        $roleAdmin->assignPermission($permWrite->id);
        $roleAdmin->save();
        $this->command->info('Permissions-roles associated.');

        //Create Suimaq developer user
        $developer = User::create(array(
            'name' => 'Suimaq Admin',
            'email' => 'moriana.mitxel@gmail.com',
            'password' => bcrypt('asfecd'),
        ));
        $this->command->info('Developer user created.');

        $developer->assignRole($roleAdmin->id);
        $developer->save();
        $this->command->info('Admin role assigned to developer user.');

        if(App::environment() !== 'local')
            exit('Not local! Do not seed!');

        //For local environment only!!!
//        $this->call('UsersSeeder');
//        $this->command->info('Users table seeded!');
		$this->call('ClientesSeeder');
        $this->command->info('Clientes table seeded!');
        $this->call('IntervencionesSeeder');
        $this->command->info('Intervenciones related tables seeded!');
        $this->call('MaquinasSeeder');
        $this->command->info('Maquinas table seeded!');
        $this->call('IncidenciasSeeder');
        $this->command->info('Incidencias table seeded!');
        $this->call('PiezasSeeder');
        $this->command->info('Piezas table seeded!');
        $this->command->info('DONE!');
	}

}
