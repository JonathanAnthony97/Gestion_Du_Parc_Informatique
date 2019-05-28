<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('id_uti');
            $table->integer('id_dep')->unsigned()->index();
            $table->foreign('id_dep')->references('id_dep')->on('departements');
            $table->string('nom_u');
            $table->string('prenom');
            $table->string('adresse')->nullable();
            $table->string('email')->unique();
            $table->string('TelPort');
            $table->string('TelFix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
