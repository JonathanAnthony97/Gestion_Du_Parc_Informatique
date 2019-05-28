<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->increments('id_inter');
            $table->integer('id_ma')->unsigned()->index();
            $table->integer('id_tier')->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('materiels')->onDelete('cascade');
            $table->foreign('id_tier')->references('id_tier')->on('tiers')->onDelete('cascade');
            $table->string('type_inter');
            $table->text('description')->nullable();
            $table->date('date_inter');
            $table->double('cout_inter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
}
