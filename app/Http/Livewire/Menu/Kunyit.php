<?php

namespace App\Http\Livewire\Menu;

use App\Models\CategoryKunyit;
use App\Models\Promotion;
use Livewire\Component;

class Kunyit extends Component
{
    public $search = '';
    public $categories, $promotions, $activeTab;

    public function selectTab($tabId)
    {
        $this->activeTab = $tabId;
    }

    public function render()
    {
        $this->categories = CategoryKunyit::query()->search($this->search)->get();
        $this->promotions = Promotion::where('status', 1)->get();
        $theme = 'kunyit';
        $logo = 'kunyit';
        return view('livewire.menu.public', [
            'categories' => $this->categories,
            'promotions' => $this->promotions,
            'search' => $this->search,
            'theme' => $theme,
            'logo' =>$logo,
        ]);
    }
}
