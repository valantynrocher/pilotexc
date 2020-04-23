<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysInAnalyticAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analytic_accounts', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('structure_id')->references('id')->on('structures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analytic_accounts', function (Blueprint $table) {
            $table->dropForeign('analytic_accounts_service_id_foreign');
            $table->dropForeign('analytic_accounts_structure_id_foreign');
        });
    }
}
