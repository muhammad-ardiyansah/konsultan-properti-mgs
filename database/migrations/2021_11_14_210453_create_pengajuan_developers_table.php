<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_developers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan', 100);
            $table->string('no_registrasi', 100)->nullable();
            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tlu_fungsi_bangunan_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tlu_tipe_rumah_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('luas_tanah', $precision = 4, $scale = 2)->nullable();
            $table->text('posisi_koordinat')->nullable();
            $table->string('klasifikasi_kompleksitas')->nullable();
            $table->decimal('ketinggian_bangunan', $precision = 4, $scale = 2)->nullable();
            $table->decimal('jumlah_lantai', $precision = 4, $scale = 2)->nullable();
            $table->decimal('luas_lantai', $precision = 4, $scale = 2)->nullable();
            $table->text('blok_rumah');
            $table->foreignId('perumahan_developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('rumah_sample', 20);
            $table->bigInteger('harga_jual_per_unit');
            $table->string('sertifikat_hak_atas_tanah')->nullable();
            $table->string('izin_pemanfataan_tanah')->nullable();
            $table->string('pengesahan_site_plan')->nullable();
            $table->string('nomor_imb')->nullable();
            $table->string('jenis_nomor_izin_lainnya')->nullable();
            $table->string('nomor_izin_lainnya')->nullable();
            $table->boolean('pengajuan_ke_apersi')->default(false);
            $table->char('province_code_apersi', 2)->nullable();
            $table->integer('tlu_sts_peng_dev_id');
            $table->bigInteger('biaya_jasa_total')->nullable();
            $table->dateTime('timestamp_pengajuan', $precision = 0);
            $table->boolean('ijin_edit')->default(false);
            $table->timestamps();

            $table->foreign('tlu_sts_peng_dev_id')
            ->references('id')
            ->on('tlu_status_pengajuan_developers')
            ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('province_code_apersi')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
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
        Schema::dropIfExists('pengajuan_developers');
    }
}
