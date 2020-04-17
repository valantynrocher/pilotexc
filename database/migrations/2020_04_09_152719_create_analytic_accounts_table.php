<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytic_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('service');
            $table->string('sector');
            $table->string('folder');
            $table->string('structure');
            $table->bigInteger('in_charge_id')->unsigned()->nullable();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytic_accounts');
    }
}
