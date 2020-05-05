<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_scriptures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('analytic_account');
            $table->bigInteger('general_account');
            $table->date('date_entry');
            $table->string('journal');
            $table->string('piece_nb')->nullable();
            $table->string('name')->nullable();
            $table->decimal('debit_amount', 15, 6)->nullable();
            $table->decimal('credit_amount', 15, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_scriptures');
    }
}
