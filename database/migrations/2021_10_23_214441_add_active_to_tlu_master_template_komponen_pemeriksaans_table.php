<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToTluMasterTemplateKomponenPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tlu_master_template_komponen_pemeriksaans', function (Blueprint $table) {
            $table->boolean('aktif')->default(true)->after('nama_master');
            $table->char('province_code', 2)->nullable()->after('aktif');

            $table->foreign('province_code')
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
        Schema::table('tlu_master_template_komponen_pemeriksaans', function (Blueprint $table) {
            $table->dropColumn('aktif');
            $table->dropForeign('tlu_master_template_komponen_pemeriksaans_province_code_foreign');
            $table->dropColumn('province_code');
        });
    }
}
