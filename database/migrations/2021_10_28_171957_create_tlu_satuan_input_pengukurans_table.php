<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTluSatuanInputPengukuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlu_satuan_input_pengukurans', function (Blueprint $table) {
            // $table->id();
            $table->integer('id');
            $table->string('nama_satuan', 30)->nullable();
            $table->string('lambang', 30)->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlu_satuan_input_pengukurans');
    }
}
