<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGeneralAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_accounts', function (Blueprint $table) {
            $table->string('cerfa_group1')->nullable()->change();
            $table->string('cerfa_line1')->nullable()->change();
            $table->string('cerfa_group2')->nullable()->change();
            $table->string('cerfa_line2')->nullable()->change();
            $table->string('cerfa_group3')->nullable()->change();
            $table->string('cerfa_line3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
