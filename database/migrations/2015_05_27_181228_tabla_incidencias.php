<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaIncidencias extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha_programada')->nullable();
            $table->dateTime('fecha_prevision_programacion');
            $table->string('estado');
            $table->string('tipo');
            $table->integer('step_posicion')->nullable();
            $table->integer('seguimiento')->nullable();
            $table->string('descripcion');
            $table->string('no_of')->nullable();
            $table->boolean('check_material');
            $table->boolean('contrato');
            $table->boolean('urgente');
            $table->integer('cliente_id')->unsigned()->index();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('maquina_id')->unsigned()->index();
            $table->foreign('maquina_id')->references('id')->on('maquinas');

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
        Schema::drop('incidencias');
    }

}