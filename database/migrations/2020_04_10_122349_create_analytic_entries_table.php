<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('analytic_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('analytic_account_id')->unsigned();
            $table->bigInteger('general_account_id')->unsigned();
            $table->date('date_entry');
            $table->string('journal');
            $table->string('piece_nb')->nullable();
            $table->string('name')->nullable();
            $table->decimal('debit_amount', 15, 6)->nullable();
            $table->decimal('credit_amount', 15, 6)->nullable();
            $table->bigInteger('entry_type_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('analytic_entries');
    }
}
