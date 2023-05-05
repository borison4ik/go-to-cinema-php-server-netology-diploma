<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallPlaceTypePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_place_type_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained();
            $table->foreignId('place_type_id')->constrained();
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hall_place_type_prices');
    }
}