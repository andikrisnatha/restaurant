<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beverage extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(CategoryBeverage::class , 'category_beverages_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BeverageTag::class, 'beverage_menu_tags');
    }


    protected $fillable = [
        'main_title',
        'user_id',
        'description',
        'price_bottle',
        'price_glass',
        'image',
        'category_beverages_id',
        'status'
    ];

    public function ScopeSearch($query, $search)
    {
        if($search) {
            $query->where(function ($query) use ($search) {
                $query->where('maintitle', 'LIKE', "%{$search}");
            });
        }
    }
}
