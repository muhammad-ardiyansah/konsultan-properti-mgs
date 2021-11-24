<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToPerumahanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perumahan_developers', function (Blueprint $table) {
            $table->text('alamat')->nullable()->after('kampung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perumahan_developers', function (Blueprint $table) {
            $table->dropColumn('alamat');
        });
    }
}
