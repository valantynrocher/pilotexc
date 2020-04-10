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
        Schema::connection('mysql2')->create('general_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_subclass_id')->unsigned();
            $table->string('name');
            $table->string('cerfa_group1');
            $table->string('cerfa_line1');
            $table->string('cerfa_group2');
            $table->string('cerfa_line2');
            $table->string('cerfa_group3');
            $table->string('cerfa_line3');
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
        Schema::connection('mysql2')->dropIfExists('general_accounts');
    }
}
