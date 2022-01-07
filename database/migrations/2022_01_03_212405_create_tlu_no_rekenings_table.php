<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTluNoRekeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlu_no_rekenings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tlu_bank_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('no_rekening', 100);
            $table->string('nama_pemilik_rekening', 100);

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
        Schema::dropIfExists('tlu_no_rekenings');
    }
}
