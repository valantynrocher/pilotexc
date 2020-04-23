<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysInCerfa1LinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cerfa1_lines', function (Blueprint $table) {
            $table->foreign('cerfa1_group_id')->references('id')->on('cerfa1_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cerfa1_lines', function (Blueprint $table) {
            $table->dropForeign('cerfa1_lines_cerfa1_group_id_foreign');
        });
    }
}
