<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_subclass_id')->unsigned();
            $table->string('name');
            $table->bigInteger('cerfa1_line_id')->unsigned()->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('general_accounts');
    }
}
