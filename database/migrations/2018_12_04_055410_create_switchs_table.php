->nullable()<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switchs', function (Blueprint $table) {
 
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('reseauMateriels')->onDelete('cascade');
            
            $table->string('type_switch')->nullable();
            //monitor
            $table->string('mrk')->nullable();
            $table->string('modele')->nullable();
            $table->string('numSer')->nullable();
            //nombre ports
            $table->integer('ethernet')->nullable();
            $table->integer('csl_port')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switchs');
    }
}
