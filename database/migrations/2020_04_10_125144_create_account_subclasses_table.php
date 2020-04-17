<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSubclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_subclasses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('account_class_id')->unsigned();
            $table->enum('detailed_result_level', ['R_Exploitation', 'R_Financier', 'R_Exceptionnel', 'R_CVN'])->nullable();
            $table->enum('compact_result_level', ['R_Courant', 'R_Exceptionnel', 'R_CVN'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_subclasses');
    }
}
