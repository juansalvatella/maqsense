<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaquinaReferenceInTablaSecuenciaSteps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('secuencia_steps', function(Blueprint $table) {
            $table->integer('maquina_id')->unsigned()->nullable()->index();
            $table->foreign('maquina_id')->references('id')->on('maquinas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('secuencia_steps', function(Blueprint $table) {
            $table->dropForeign('secuencia_steps_maquina_id_foreign');
            $table->dropColumn('maquina_id');
        });
	}

}
