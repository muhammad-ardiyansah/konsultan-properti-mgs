<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('nama_direktur');
            $table->string('no_kta_apersi');
            $table->char('province_code', 2);            
            $table->text('alamat');
            $table->string('no_hp', 30);
            $table->bigInteger('created_by')->nullable();;
            $table->bigInteger('updated_by')->nullable();;            
            $table->timestamps();            
            $table->foreign('province_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
                ->onUpdate('cascade')->onDelete('restrict');                        
        });

        Schema::create('developer_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('developer_id')->constrained();
        });        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');
    }
}
