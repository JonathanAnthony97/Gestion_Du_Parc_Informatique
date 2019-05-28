<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reforms', function (Blueprint $table) {
            $table->increments('id_rf');
            $table->integer('id_ma')->unsigned()->index();
            $table->string('type_rf');
            $table->date('date_reform');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reforms');
    }
}
