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
            $table->string('no_invoice', 100);
            $table->string('nama_perusahaan');
            $table->string('no_telpon')->nullable();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('npwp')->nullable();
            $table->string('ktp_nik')->nullable();
            $table->string('email')->nullable();
            $table->string('referensi')->nullable();
            $table->string('no_referensi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('blok_invoice')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_due_date')->nullable();
            $table->bigInteger('kode_unik')->nullable();
            $table->bigInteger('jumlah_tagihan')->nullable();
            $table->bigInteger('total_tagihan')->nullable();
            $table->boolean('paid')->default(false);
            $table->boolean('view_without_paid')->default(false);
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
