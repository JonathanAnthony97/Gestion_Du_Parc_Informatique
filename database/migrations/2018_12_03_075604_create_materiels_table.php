<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->increments('id_ma');
            $table->integer('id_catg')->unsigned()->index();
            $table->foreign('id_catg')->references('id_catg')->on('materielCategories');

            $table->string('num_serie')->nullable();
            $table->string('marque')->nullable();
            $table->string('model')->nullable();
            $table->integer('garantie')->nullable();
            $table->dateTime('date_acqui');

            $table->integer('id_tier')->unsigned()->index();
            $table->integer('id_eta')->unsigned()->index();
            
            $table->integer('dure_vie')->nullable();
            $table->integer('maintenable')->nullable();
            $table->date('date_renouv')->nullable();
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
        Schema::dropIfExists('materiels');
    }
}
