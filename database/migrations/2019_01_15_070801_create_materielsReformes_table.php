<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterielsReformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materielsReformes', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('reforms')->onDelete('cascade');
            $table->integer('id_catg')->unsigned()->index();
            $table->string('num_serie')->nullable();
            $table->string('marque')->nullable();
            $table->string('model')->nullable();
            $table->dateTime('date_acqui');
            $table->string('type');
            $table->integer('id_tier')->unsigned()->index();
    
            $table->float('vlr_acqui')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materielsReformes');
    }
}
