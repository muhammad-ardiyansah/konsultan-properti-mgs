<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPengajuanBlokRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pengajuan_blok_rumahs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pengajuan_developer_detail_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('perumahan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('blok_rumah', 10);
            $table->dateTime('timestamp', $precision = 0); 
            $table->text('catatan')->nullable(); 

            $table->integer('id_status_blok_rumah');
            $table->string('nama_status_blok_rumah', 60);
            $table->string('role_status_blok_rumah', 60);

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('log_pengajuan_blok_rumahs');
    }
}
