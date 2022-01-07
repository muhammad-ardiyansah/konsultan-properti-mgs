<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPengawasIdToPengajuanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_developers', function (Blueprint $table) {
            $table->unsignedBigInteger('pengawas_id')->nullable()->after('ijin_edit');
            
            $table->foreign('pengawas_id')->references('id')->on('pengawas')->onUpdate('cascade')->onDelete('restrict');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_developers', function (Blueprint $table) {
            $table->dropForeign('pengajuan_developers_pengawas_id_foreign');
            $table->dropColumn('pengawas_id');
        });
    }
}
