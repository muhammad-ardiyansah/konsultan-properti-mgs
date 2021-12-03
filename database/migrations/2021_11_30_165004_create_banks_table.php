<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           
            $table->text('alamat')->nullable();
            $table->string('no_telpon', 30)->nullable();            
            $table->timestamps();
        });

        Schema::create('bank_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('bank_id')->constrained();
        });        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
