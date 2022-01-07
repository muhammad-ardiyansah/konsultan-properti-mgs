<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pengajuan_developer_detail_id')->constrained()->onUpdate('cascade')->onDelete('restrict');            
            $table->string('param');
            $table->string('nama_file');
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
        Schema::dropIfExists('hasil_laporans');
    }
}
