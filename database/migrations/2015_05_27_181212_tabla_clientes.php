<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaClientes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('vip');
            $table->string('nombre');
            $table->string('persona_contacto');
            $table->string('tlf_contacto');
            $table->string('direccion');
            $table->string('observaciones');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE `clientes` ADD FULLTEXT search(nombre)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function(Blueprint $table) {
            $table->dropIndex('search');
        });
        Schema::drop('clientes');
    }

}