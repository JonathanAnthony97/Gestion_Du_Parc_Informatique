<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeripheriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripheriques', function (Blueprint $table) {
            $table->integer('id_ma')->primary()->unsigned()->index();
            $table->foreign('id_ma')->references('id_ma')->on('materiels')->onDelete('cascade');
            $table->integer('id_catg')->unsigned()->index();
            $table->string('netbios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peripheriques');
    }
}
