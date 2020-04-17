<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analytic_accounts', function (Blueprint $table) {
            $table->bigInteger('client_id')->unsigned()->nullable();
        });

        Schema::table('analytic_entries', function (Blueprint $table) {
            $table->bigInteger('client_id')->unsigned()->nullable();
        });

        Schema::table('general_accounts', function (Blueprint $table) {
            $table->bigInteger('client_id')->unsigned()->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('client_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
