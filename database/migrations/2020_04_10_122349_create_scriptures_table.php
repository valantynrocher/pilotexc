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
            $table->bigInteger('analytic_account_id')->unsigned();
            $table->bigInteger('general_account_id')->unsigned();
            $table->date('date_entry');
            $table->string('journal');
            $table->string('piece_nb')->nullable();
            $table->string('name')->nullable();
            $table->decimal('debit_amount', 15, 6)->nullable();
            $table->decimal('credit_amount', 15, 6)->nullable();
            $table->enum('entry_type', ['Situation', 'Réalisé', 'Prévisionnel']);
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
        Schema::dropIfExists('analytic_entries');
    }
}
