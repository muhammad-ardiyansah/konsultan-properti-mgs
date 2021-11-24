<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateKomponenPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_komponen_pemeriksaans', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('tlu_master_template_id');
            $table->string('no_komponen', 20)->nullable();
            $table->string('nama_komponen')->nullable();
            $table->string('text_komponen')->nullable();
            
            $table->tinyInteger('jenis_pengukuran_1')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox')->default(0);            
            $table->string('satuan_input_pengukuran_1', 30)->nullable();
            $table->string('text_sebelum_input_pengukuran_1', 100)->nullable();
            $table->string('list_data_input_pengukuran_1')->nullable();

            $table->tinyInteger('jenis_pengukuran_2')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox')->default(0);            
            $table->boolean('input_pengukuran_2_sbg_baris_baru')->default(false);
            $table->string('satuan_input_pengukuran_2', 30)->nullable();
            $table->string('text_sebelum_input_pengukuran_2', 100)->nullable();
            $table->string('list_data_input_pengukuran_2')->nullable();

            $table->tinyInteger('jenis_pengukuran_3')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox')->default(0);            
            $table->boolean('input_pengukuran_3_sbg_baris_baru')->default(false);
            $table->string('satuan_input_pengukuran_3', 30)->nullable();
            $table->string('text_sebelum_input_pengukuran_3', 100)->nullable();
            $table->string('list_data_input_pengukuran_3')->nullable();       
            
            $table->boolean('checklist_kesesuaian')->default(false);

            $table->timestamps();
            
            $table->foreign('tlu_master_template_id')
            ->references('id')
            ->on('tlu_master_template_komponen_pemeriksaans')
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
        Schema::dropIfExists('template_komponen_pemeriksaans');
    }
}
