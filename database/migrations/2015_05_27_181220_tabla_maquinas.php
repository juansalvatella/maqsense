<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaMaquinas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinas', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('puesta_en_marcha')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('doc');
            $table->string('no_serie');
            $table->integer('horas_funcionamiento')->unsigned();
            $table->integer('no_revisiones_anuales')->unsigned();
            $table->string('patron_intervenciones');
            $table->integer('pos_intervencion_inicial')->unsigned()->nullable();
//            $table->string('localizacion');
            $table->string('observaciones');
            $table->integer('cliente_id')->unsigned()->index();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE maquinas ADD FULLTEXT searchMarca(marca)');
        DB::statement('ALTER TABLE maquinas ADD FULLTEXT searchModelo(modelo)');
        DB::statement('ALTER TABLE maquinas ADD FULLTEXT searchSerie(no_serie)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maquinas', function(Blueprint $table) {
            $table->dropIndex('searchMarca');
            $table->dropIndex('searchModelo');
            $table->dropIndex('searchSerie');
        });
        Schema::drop('maquinas');
    }

}