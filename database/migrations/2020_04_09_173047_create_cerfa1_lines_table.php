<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCerfa1LinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cerfa1_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('cerfa1_group_id')->unsigned()->nullable();
        });

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
        Schema::dropIfExists('cerfa1_lines');
    }
}
