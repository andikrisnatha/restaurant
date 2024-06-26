<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BeverageTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function beverages() : HasMany 
    {
        return $this->hasMany(Beverage::class);
    }
}
