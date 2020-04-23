<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCerfa1GroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cerfa1_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('direct_indirect', ['Direct', 'Indirect']);
            $table->enum('charges_produits', ['Charges', 'Produits']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cerfa1_groups');
    }
}
