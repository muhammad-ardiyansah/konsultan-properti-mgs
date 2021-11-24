<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDeveloperDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_developer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('perumahan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('blok_rumah', 10);
            $table->integer('tlu_sts_peng_blk_rmh_id');
            $table->text('keterangan')->nullable();
            $table->integer('biaya_jasa_per_unit');
            $table->timestamps();

            $table->foreign('tlu_sts_peng_blk_rmh_id')
            ->references('id')
            ->on('tlu_status_pengajuan_blok_rumahs')
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
        Schema::dropIfExists('pengajuan_developer_details');
    }
}
