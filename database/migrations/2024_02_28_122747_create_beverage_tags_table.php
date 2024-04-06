<?php

use App\Models\Beverage;
use App\Models\BeverageTag;
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
        Schema::create('beverage_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('beverage_menu_tags', function (Blueprint $table) {
            $table->foreignIdFor(Beverage::class);
            $table->foreignIdFor(BeverageTag::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beverage_tags');
        Schema::dropIfExists('beverage_menu_tags');
    }
};
