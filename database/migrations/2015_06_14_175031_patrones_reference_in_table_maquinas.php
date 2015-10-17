<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatronesReferenceInTableMaquinas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maquinas', function(Blueprint $table) {
            $table->dropColumn('patron_intervenciones');
            $table->integer('patrones_id')->unsigned()->nullable()->index();
            $table->foreign('patrones_id')->references('id')->on('patrones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maquinas', function(Blueprint $table) {
            $table->string('patron_intervenciones');
            $table->dropForeign('maquinas_patrones_id_foreign');
            $table->dropColumn('patrones_id');
        });
    }
}
