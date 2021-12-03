<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPengajuanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pengajuan_developers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('perumahan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->dateTime('timestamp', $precision = 0); 
            $table->text('catatan')->nullable();
       
            $table->integer('id_status_peng_dev');
            $table->string('nama_status_peng_dev', 60);
            $table->string('keterangan_status_peng_dev')->nullable();
            $table->string('role_status_peng_dev', 60);

            $table->boolean('pengajuan_ke_apersi')->default(false);;
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
        Schema::dropIfExists('log_pengajuan_developers');
    }
}
