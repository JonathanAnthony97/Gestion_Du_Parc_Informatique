->nullable()<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecrans', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('peripheriques')->onDelete('cascade');
            //monitor
            $table->string('mrk')->nullable();
            $table->string('modele')->nullable();
            $table->string('numSer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecrans');
    }
}
