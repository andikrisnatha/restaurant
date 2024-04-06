<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KunyitMenu extends Model
{
    use HasFactory;

    public function categories()
    {
       return $this->belongsTo(CategorySands::class, 'category_sands_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(MenuTag::class, 'kunyit_menu_tags');
    }

    protected $fillable = [
        'main_title',
        'user_id',
        'description',
        'title_1',
        'title_2',
        'title_3',
        'title_4',
        'price_1',
        'price_2',
        'price_3',
        'price_4',
        'image',
        'video_url',
        'category_kunyit_id',
        'status',
    ];

    public function ScopeSearch($query, $search)
    {
        if($search) {
            $query->where(function ($query) use ($search) {
                $query->where('main_title', 'LIKE', "%{$search}%");
            });
        }
    }
}
