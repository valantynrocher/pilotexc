<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scriptures', function (Blueprint $table) {
            $table->foreign('analytic_account_id')->references('id')->on('analytic_accounts');
            $table->foreign('general_account_id')->references('id')->on('general_accounts');
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
            $table->dropForeign('scriptures_analytic_account_id_foreign');
            $table->dropForeign('scriptures_general_account_id_foreign');
        });

    }
}
