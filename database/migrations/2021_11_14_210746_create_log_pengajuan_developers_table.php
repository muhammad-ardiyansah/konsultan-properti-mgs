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
            $table->integer('tlu_sts_peng_dev_id');  
            $table->text('keterangan')->nullable(); 
            $table->boolean('pengajuan_ke_apersi')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');        
            $table->timestamps();

            $table->foreign('tlu_sts_peng_dev_id')
            ->references('id')
            ->on('tlu_status_pengajuan_developers')
            ->onUpdate('cascade')->onDelete('restrict');
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
