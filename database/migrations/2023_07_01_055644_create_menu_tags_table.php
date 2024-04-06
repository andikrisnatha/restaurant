<?php

use App\Models\KunyitMenu;
use App\Models\MenuTag;
use App\Models\SandsMenu;
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
        Schema::create('menu_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('sands_menu_tags', function (Blueprint $table) {
            $table->foreignIdFor(SandsMenu::class);
            $table->foreignIdFor(MenuTag::class);
        });

        Schema::create('kunyit_menu_tags', function (Blueprint $table) {
            $table->foreignIdFor(KunyitMenu::class);
            $table->foreignIdFor(MenuTag::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sands_menu_tags');
        Schema::dropIfExists('kunyit_menu_tags');
        Schema::dropIfExists('menu_tags');
    }
};
