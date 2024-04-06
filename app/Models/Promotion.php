<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'image',
        'status',
    ];

    public function ScopeSearch($query, $search)
    {
        if($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            });
        }
    }
}
