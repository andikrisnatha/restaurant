<?php

namespace App\Http\Livewire\Menu\Cms\Beverage;

use App\Models\CategoryBeverage;
use Livewire\Component;

class Category extends Component
{
    public $description, $categoryId;
    public $editMode = false;

    public $rules = [
        'description' =>'required'
    ];

    public function resetForm()
    {
        $this->description = '';
        $this->id = '';
    }

    public function render()
    {
        $categories = CategoryBeverage::all();
        return view('livewire.menu.cms.beverage.category.category', compact('categories'));
    }

    public function modelData()
    {
        return [
            'description' => $this->description
        ];
    }

    public function store()
    {

        $category = new CategoryBeverage();
        $category->description = $this->description;
        $category->save();
        $this->resetForm();
    }

    public function edit($id)
    {
        $category = CategoryBeverage::findOrFail($id);
        $this->categoryId = $category->id;
        $this->description = $category->description;
        $this->editMode = true;
    }

    public function update()
    {
        $category = CategoryBeverage::findOrFail($this->categoryId);
        $category->description = $this->description;
        $category->save();
        $this->resetForm();
        $this->editMode = false;
    }

    public function delete($id)
    {
        $category = CategoryBeverage::findOrFail($id);
        $category->delete();
    }
}
