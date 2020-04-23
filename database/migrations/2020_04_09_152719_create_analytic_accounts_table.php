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
            $table->boolean('active')->default(1);
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->bigInteger('structure_id')->unsigned()->nullable();
            $table->bigInteger('in_charge_id')->unsigned()->nullable();
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
        Schema::dropIfExists('analytic_accounts');
    }
}
