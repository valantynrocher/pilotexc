<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiscalYearForeignKeyInScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scriptures', function (Blueprint $table) {
            $table->bigInteger('fiscal_year_id')->unsigned()->nullable()->after('id');
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scriptures', function (Blueprint $table) {
            $table->dropForeign('scriptures_fiscal_year_id_foreign');
            $table->drop('fiscal_year_id');
        });
    }
}
