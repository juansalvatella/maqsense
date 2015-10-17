<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPiezas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piezas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('referencia');
            $table->integer('cantidad')->unsigned();
            $table->integer('tipo_intervenciones_id')->unsigned()->index();
            $table->foreign('tipo_intervenciones_id')->references('id')->on('tipo_intervenciones');
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
        Schema::drop('piezas');
    }

}
