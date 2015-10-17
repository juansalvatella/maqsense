<?php namespace App\Providers;

use App\Incidencia;
use Illuminate\Support\ServiceProvider;
use Liebig\Cron\Cron;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        \Event::listen('cron.collectJobs', function() {
            Cron::add('Set delayed incidents state to urgent', '0 4 * * *', function() { //once every day at 4:00 a.m.
                $delayed_inc_no_prog = Incidencia::where('estado','<>','Cerrada')
                    ->where('estado','<>','Programada')
                    ->where('fecha_prevision_programacion','<=', new \DateTime('today'))
                    ->get();

                foreach($delayed_inc_no_prog as $dinp) {
                    $dinp->urgente = true;
                    $dinp->save();
                }

                $delayed_inc_prog = Incidencia::where('estado','Programada')
                    ->where('fecha_programada','<=', new \DateTime('today'))
                    ->get();

                foreach($delayed_inc_prog as $dip) {
                    $dip->urgente = true;
                    $dip->save();
                }

                return null;
            });

            Cron::add('Crear inidencias a partir de patrones a 1 año vista', '15 4 * * *', function() { //once every day at 4:15 a.m.


                return null;
            });

        });
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
