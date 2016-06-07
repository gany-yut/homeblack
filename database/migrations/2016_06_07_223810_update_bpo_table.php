<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bpo', function (Blueprint $table) {
            //
            $table -> tinyInteger('status') ->default(1) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bpo', function (Blueprint $table) {
            //
            $table -> dropColumn('status');
        });
    }
}
