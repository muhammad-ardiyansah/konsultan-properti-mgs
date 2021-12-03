<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpds', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->char('province_code', 2);            
            $table->text('alamat')->nullable();
            $table->string('no_telpon', 30)->nullable();          
            $table->timestamps();

            $table->foreign('province_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
                ->onUpdate('cascade')->onDelete('restrict');            

        });

        Schema::create('dpd_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dpd_id')->constrained();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dpds');
    }
}
