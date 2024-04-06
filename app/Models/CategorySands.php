<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorySands extends Model
{
    use HasFactory;

    public function menus() : HasMany
    {
       return $this->hasMany(SandsMenu::class);
    }

    protected $fillable = [
        'description',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->with(['menus' => function ($query) use ($search) {
            $query->where('status', true);
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('main_title', 'LIKE', "%$search%")
                        ->orWhereHas('tags', function ($query) use ($search){
                            $query->where('title', 'LIKE', "%$search%");
                        });
                });
            }
        }])
        ->whereHas('menus', function ($query) use ($search) {
            $query->where('status', true);
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('main_title', 'LIKE', "%$search%")
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('title', 'LIKE', "%$search%");
                    });
                });
            }
        });
    }
}
