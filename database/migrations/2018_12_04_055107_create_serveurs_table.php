<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serveurs', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('reseauMateriels')->onDelete('cascade');

            $table->ipAddress('ipAdr')->nullable();
            //cpu
            $table->integer('nbProces')->nullable();
            $table->string('model_cpu')->nullable();
            $table->double('frequences')->nullable();
            //ram
            $table->integer('memoChips')->nullable();
            $table->string('type_memo')->nullable();
            $table->integer('total')->nullable();
            //hard disk
            $table->integer('nbDisk')->nullable();
            $table->string('type_disk')->nullable();
            $table->integer('taille_par_disk')->nullable();
            $table->string('type_raid')->nullable();
            //nombre_port
            $table->integer('ethernet')->nullable();
            $table->integer('csl_port')->nullable();
            //os
            $table->string('type_os')->nullable();
            $table->string('lang_os')->nullable();
            $table->integer('srv_pack')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serveurs');
    }
}
