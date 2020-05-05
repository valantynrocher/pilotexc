<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResultAmountInScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scriptures', function (Blueprint $table) {
            $table->decimal('result_amount', 15, 6)->nullable()->after('credit_amount');
        });
    }
}
