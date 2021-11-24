<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateStrukturalFondasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_struktural_fondasis', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('tlu_master_template_id');
            $table->string('no_komponen', 20)->nullable();
            $table->string('nama_komponen')->nullable();
            $table->string('text_komponen')->nullable();
            
            $table->tinyInteger('jenis_input_pengukuran_1')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox, 4=Selectbox')->default(0);            
            $table->string('satuan_input_pengukuran_1', 30)->nullable();
            $table->string('label_1')->nullable();
            $table->string('list_data_input_pengukuran_1')->nullable();
            $table->boolean('grup_checkbox_1_tanpa_label')->default(false);

            $table->tinyInteger('jenis_input_pengukuran_2')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox, 4=Selectbox')->default(0);            
            $table->boolean('input_pengukuran_2_sbg_baris_baru')->default(false);
            $table->string('satuan_input_pengukuran_2', 30)->nullable();
            $table->string('label_2', 100)->nullable();
            $table->string('list_data_input_pengukuran_2')->nullable();
            $table->boolean('grup_checkbox_2_tanpa_label')->default(false);

            $table->tinyInteger('jenis_input_pengukuran_3')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox, 4=Selectbox')->default(0);            
            $table->boolean('input_pengukuran_3_sbg_baris_baru')->default(false);
            $table->string('satuan_input_pengukuran_3', 30)->nullable();
            $table->string('label_3', 100)->nullable();
            $table->string('list_data_input_pengukuran_3')->nullable();
            $table->boolean('grup_checkbox_3_tanpa_label')->default(false);

            $table->tinyInteger('jenis_input_pengukuran_4')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox, 4=Selectbox')->default(0);            
            $table->boolean('input_pengukuran_4_sbg_baris_baru')->default(false);
            $table->string('satuan_input_pengukuran_4', 30)->nullable();
            $table->string('label_4', 100)->nullable();
            $table->string('list_data_input_pengukuran_4')->nullable();
            $table->boolean('grup_checkbox_4_tanpa_label')->default(false);            

            $table->text('print_on_template')->nullable();

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
        Schema::dropIfExists('template_struktural_fondasis');
    }
}
