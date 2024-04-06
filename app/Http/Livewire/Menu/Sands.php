<?php

namespace App\Http\Livewire\Menu;

use App\Models\CategorySands;
use App\Models\Promotion;
use Livewire\Component;

class Sands extends Component
{
    public $search = '';
    public $categories, $promotions;


    public function clearSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        $this->categories = CategorySands::query()->search($this->search)->get();
        $this->promotions = Promotion::where('status', 1)->get();
        $theme = 'sands';
        $logo = 'sands';
        return view('livewire.menu.public', [
            'categories' => $this->categories,
            'promotions' => $this->promotions,
            'search' => $this->search,
            'theme' => $theme,
            'logo' => $logo,
        ]);


    }
}
