<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerumahanDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perumahan_developers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama_perumahan');
            $table->char('province_code', 2);
            $table->char('city_code', 4);
            $table->char('district_code', 7);
            $table->char('village_code', 10)->nullable();
            $table->string('kampung')->nullable();
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
                
                $table->foreign('village_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'villages')
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
        Schema::dropIfExists('perumahan_developers');
    }
}
