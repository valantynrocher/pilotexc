<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scriptures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fiscal_year_id')->unsigned()->nullable();
            $table->bigInteger('analytic_account_id')->unsigned();
            $table->bigInteger('general_account_id')->unsigned();
            $table->date('date_entry');
            $table->string('journal');
            $table->string('piece_nb')->nullable();
            $table->string('name')->nullable();
            $table->decimal('debit_amount', 15, 6)->nullable();
            $table->decimal('credit_amount', 15, 6)->nullable();
            $table->decimal('result_amount', 15, 6)->nullable();
            $table->enum('entry_type', ['Situation', 'Réalisé', 'Prévisionnel']);
            $table->bigInteger('client_id')->unsigned()->nullable();
        });

        Schema::table('scriptures', function (Blueprint $table) {
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years');
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
        Schema::dropIfExists('analytic_entries');
    }
}
