<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaSecuenciaSteps extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secuencia_steps', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('posicion')->unsigned();
            $table->integer('periodo')->nullable()->unsigned();
//            $table->integer('seguimiento')->nullable();
            $table->integer('tipo_intervenciones_id')->unsigned()->index();
            $table->foreign('tipo_intervenciones_id')->references('id')->on('tipo_intervenciones');
            $table->integer('patrones_id')->unsigned()->nullable()->index();
            $table->foreign('patrones_id')->references('id')->on('patrones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('secuencia_steps');
    }

}
