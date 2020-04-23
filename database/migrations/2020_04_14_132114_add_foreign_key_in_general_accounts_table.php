<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInGeneralAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_accounts', function (Blueprint $table) {
            $table->foreign('account_subclass_id')->references('id')->on('account_subclasses');
            $table->foreign('cerfa1_line_id')->references('id')->on('cerfa1_lines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_accounts', function (Blueprint $table) {
            $table->dropForeign('general_accounts_account_subclass_id_foreign');
            $table->dropForeign('general_accounts_cerfa1_line_id_foreign');
        });
    }
}
