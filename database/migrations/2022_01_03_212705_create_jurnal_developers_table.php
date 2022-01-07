<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_developers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('invoice_header_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('param', 30);
            $table->bigInteger('jumlah')->nullable();

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
        Schema::dropIfExists('jurnal_developers');
    }
}
