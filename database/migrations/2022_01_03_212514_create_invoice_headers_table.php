<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('developer_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pengajuan_developer_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tlu_no_rekening_id')->constrained()->onUpdate('cascade')->onDelete('restrict');     
            $table->string('no_invoice', 100);
            $table->string('nama_perusahaan');
            $table->string('no_telpon');
            $table->string('nama');
            $table->text('alamat');
            $table->string('npwp');
            $table->string('ktp_nik');
            $table->string('email');
            $table->string('referensi');
            $table->string('no_referensi');
            $table->text('keterangan')->nullable();
            $table->dateTime('timestamp_pembuatan', $precision = 0)->nullable();
            $table->dateTime('timestamp_tenggat_waktu', $precision = 0)->nullable();
            $table->bigInteger('kode_unik')->nullable();
            $table->bigInteger('jumlah_tagihan')->nullable();
            $table->bigInteger('total_tagihan')->nullable();

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
        Schema::dropIfExists('invoice_headers');
    }
}
