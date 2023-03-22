<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('slug', 50)->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('room_n');
            $table->tinyInteger('bed_n');
            $table->tinyInteger('bath_n');
            $table->integer('square_meters');
            $table->boolean('visible');
            $table->string('address', 100);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->string('cover_img');
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
        Schema::dropIfExists('apartments');
    }
};
