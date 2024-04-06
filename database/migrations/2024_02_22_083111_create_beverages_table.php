<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('main_title');
            $table->string('description');
            $table->integer('price_bottle')->nullable();
            $table->integer('price_glass')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('category_beverages_id');
            $table->boolean('status');
            // $table->string('video_url')->nulable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beverages');
    }
};
