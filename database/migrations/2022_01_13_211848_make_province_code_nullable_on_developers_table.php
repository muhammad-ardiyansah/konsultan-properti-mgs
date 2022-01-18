<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;

class MakeProvinceCodeNullableOnDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }        

        Schema::table('developers', function (Blueprint $table) {
            $table->char('province_code', 2)->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }        

        Schema::table('developers', function (Blueprint $table) {
            $table->char('province_code', 2)->nullable(false)->change();
        });
    }
}
