<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_header_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pengajuan_developer_detail_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');            
            $table->text('keterangan')->nullable();
            $table->bigInteger('harga_satuan')->nullable();

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
        Schema::dropIfExists('invoice_details');
    }
}