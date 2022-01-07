<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawas', function (Blueprint $table) {
            $table->id();

            $table->string('no_register');
            $table->string('nama_perusahaan');
            $table->string('email')->unique();
            $table->string('nama_direktur');
            $table->string('nama_penanggung_jawab')->nullable();
            $table->char('province_code', 2);
            $table->char('city_code', 4);
            $table->char('district_code', 7);
            $table->text('alamat')->nullable();
            $table->string('no_telpon', 30)->nullable();

            $table->timestamps();

            $table->foreign('province_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
                ->onUpdate('cascade')->onDelete('restrict');       

            $table->foreign('city_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'cities')
                ->onUpdate('cascade')->onDelete('restrict');        
                
            $table->foreign('district_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'districts')
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
        Schema::dropIfExists('pengawas');
    }
}
