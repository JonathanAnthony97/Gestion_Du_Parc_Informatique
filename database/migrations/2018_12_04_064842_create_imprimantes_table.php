<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImprimantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imprimantes', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('peripheriques')->onDelete('cascade');
            $table->string('type_impr')->nullable();
            $table->string('couleur')->nullable();
            $table->string('fct_scan')->nullable();
            $table->string('fct_fax')->nullable();
            $table->string('fct_copy')->nullable();
            $table->string('crt_reso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imprimantes');
    }
}
