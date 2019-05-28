<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('reseauMateriels')->onDelete('cascade');
            //hard disk
            $table->integer('nbDisk')->nullable();
            $table->string('type_disk')->nullable();
            $table->integer('taille_par_disk')->nullable();
            $table->string('type_raid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storages');
    }
}
