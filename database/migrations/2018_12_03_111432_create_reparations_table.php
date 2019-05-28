<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->increments('id_rp');
            $table->integer('id_inter')->unsigned()->index();
            $table->integer('id_pan')->unsigned()->index();
            $table->foreign('id_inter')->references('id_inter')->on('interventions')->onDelete('cascade');
            $table->text('piece');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparations');
    }
}
