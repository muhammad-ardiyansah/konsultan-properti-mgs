<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_header_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tlu_no_rekening_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('bank_pengirim');
            $table->string('no_rekening_pengirim');
            $table->string('nama_pemilik_rekening_pengirim');
            $table->date('tgl_transfer');
            $table->boolean('konfirmasi')->default(false);
            $table->dateTime('timestamp_konfirmasi', $precision = 0);
            $table->string('bukti_transfer');
            $table->boolean('bayar')->default(false);
            $table->dateTime('timestamp_verifikasi_byr', $precision = 0);
            $table->bigInteger('jumlah_konfirmasi')->nullable();
            $table->bigInteger('jumlah_bayar')->nullable();
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
        Schema::dropIfExists('pembayarans');
    }
}
