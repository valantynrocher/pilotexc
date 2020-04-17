<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInAccountSubclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_subclasses', function (Blueprint $table) {
            $table->foreign('account_class_id')->references('id')->on('account_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_subclasses', function (Blueprint $table) {
            $table->dropForeign('account_subclasses_account_class_id_foreign');
        });
    }
}
