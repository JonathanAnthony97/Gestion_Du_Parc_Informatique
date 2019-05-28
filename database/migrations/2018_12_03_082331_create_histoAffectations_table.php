<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histoAffectations', function (Blueprint $table) {
            $table->increments('id_histo');
            $table->integer('id_ma')->unsigned()->index();
            $table->integer('id_dep')->unsigned()->index();
            $table->integer('id_uti')->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('materiels')->onDelete('cascade');
            $table->dateTime('date_aff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histoAffectations');
    }
}
