<?php

namespace App\Http\Livewire\Menu;

use App\Models\Beverage as ModelsBeverage;
use App\Models\CategoryBeverage;
use App\Models\Promotion;
use Livewire\Component;

class Beverage extends Component
{
    public $search = '';

    public $categories, $promotions, $beverages;

    public function clearSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        $this->categories = CategoryBeverage::query()->search($this->search)->get();
        $this->beverages = ModelsBeverage::where('status', 1)->get();
        $this->promotions = Promotion::where('status', 1)->get();

        // $logo = 'anvaya';

        return view('livewire.menu.beverage', [
            'categories' => $this->categories,
            'promotion' => $this->promotions,
            'search' => $this->search,
            'beverages' => $this->beverages,
            // 'logo' => $this->logo
        ]);
    }
}
