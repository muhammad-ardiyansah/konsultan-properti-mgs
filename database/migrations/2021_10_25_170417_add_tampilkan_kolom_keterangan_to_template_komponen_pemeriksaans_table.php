<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTampilkanKolomKeteranganToTemplateKomponenPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_komponen_pemeriksaans', function (Blueprint $table) {
            // $table->boolean('tampilkan_kolom_keterangan')->default(false)->after('checklist_kesesuaian');
        
            $table->tinyInteger('jenis_keterangan')->comment('0=Tidak ada input, 1=Input Angka, 2=Input Text, 3=Checkbox')->default(0)->after('checklist_kesesuaian');            
            $table->string('satuan_input_keterangan', 30)->nullable()->after('jenis_keterangan');
            $table->string('text_sebelum_input_keterangan', 100)->nullable()->after('satuan_input_keterangan');
            $table->string('list_data_input_keterangan')->nullable()->after('text_sebelum_input_keterangan');            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_komponen_pemeriksaans', function (Blueprint $table) {
            // $table->dropColumn('tampilkan_kolom_keterangan');
            $table->dropColumn('jenis_keterangan');
            $table->dropColumn('satuan_input_keterangan');
            $table->dropColumn('text_sebelum_input_keterangan');
            $table->dropColumn('list_data_input_keterangan');
        });
    }
}
