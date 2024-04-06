<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuTag extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    /**
     * Get all of the menus for the MenuTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus(): HasMany
    {
        return $this->hasMany(SandsMenu::class);
    }

    /**
     * Get all of the menus for the MenuTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kunyitMenus(): HasMany
    {
        return $this->hasMany(KunyitMenu::class);
    }
}
