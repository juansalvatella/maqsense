<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntevencionReferenceInTableIncidencias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('incidencias', function(Blueprint $table) {
            $table->integer('tipo_intervenciones_id')->unsigned()->nullable()->index();
            $table->foreign('tipo_intervenciones_id')->references('id')->on('tipo_intervenciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidencias', function(Blueprint $table) {
            $table->dropForeign('incidencias_tipo_intervenciones_id_foreign');
            $table->dropColumn('tipo_intervenciones_id');
        });
    }

}
