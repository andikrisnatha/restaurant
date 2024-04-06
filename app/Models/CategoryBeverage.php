<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryBeverage extends Model
{
    protected $fillable = [
        'description',
    ];
    
    public function beverages()
    {
        return $this->hasMany(Beverage::class, 'category_beverages_id', 'id');
    }

    use HasFactory;

    // public function scopeSearch($query, $search)
    // {
    //     return $query->with(['beverages' => function ($query) use ($search) {
    //         $query->where('status', true);
    //         if ($search) {
    //             $query->where(function ($query) use ($search) {
    //                 $query->where('main_title', 'LIKE', "%$search%")
    //                     ->orWhereHas('tags', function ($query) use ($search){
    //                         $query->where('title', 'LIKE', "%$search%");
    //                     });
    //             });
    //         }
    //     }]);
    // }

    public function scopeSearch($query, $search)
    {
        return $query->with(['beverages' => function ($query) use ($search) {
            $query->where('status', true);
            if($search) {
                $query->where('main_title', 'LIKE', "%$search%");
            }
        }]);
    }
}
