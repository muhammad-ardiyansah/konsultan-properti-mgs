<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnToTemplateKomponenPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_komponen_pemeriksaans', function (Blueprint $table) {
            $table->renameColumn('jenis_pengukuran_1', 'jenis_input_pengukuran_1');
            $table->renameColumn('jenis_pengukuran_2', 'jenis_input_pengukuran_2');
            $table->renameColumn('jenis_pengukuran_3', 'jenis_input_pengukuran_3');
            $table->renameColumn('jenis_keterangan', 'jenis_input_keterangan');
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
            $table->dropColumn('jenis_input_pengukuran_1');
            $table->dropColumn('jenis_input_pengukuran_2');
            $table->dropColumn('jenis_input_pengukuran_3');
            $table->dropColumn('jenis_input_keterangan');
        });
    }
}
