<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenunutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menunutrients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->float('calories');
            $table->float('protein');
            $table->float('potassium');
            $table->float('phosphorus');
            $table->float('sodium');
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
        Schema::dropIfExists('menunutrients');
    }
}
