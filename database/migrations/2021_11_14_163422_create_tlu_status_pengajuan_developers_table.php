<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTluStatusPengajuanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlu_status_pengajuan_developers', function (Blueprint $table) {
            // $table->id();
            $table->integer('id');
            $table->string('nama_status', 60);
            $table->string('keterangan');
            $table->json('pilihan_status')->nullable();
            $table->string('role', 60);
            $table->timestamps();
        
            $table->primary('id');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlu_status_pengajuan_developers');
    }
}
