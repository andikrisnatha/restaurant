<?php

namespace App\Http\Livewire\Menu\Cms\Sands;

use App\Models\CategorySands;
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
        $categories = CategorySands::all();
        return view('livewire.menu.cms.sands.category.category', compact('categories'));
    }

    public function modelData()
    {
        return [
            'description' => $this->description
        ];
    }

    public function store()
    {

        $category = new CategorySands();
        $category->description = $this->description;
        $category->save();
        $this->resetForm();
    }

    public function edit($id)
    {
        $category = CategorySands::findOrFail($id);
        $this->categoryId = $category->id;
        $this->description = $category->description;
        $this->editMode = true;
    }

    public function update()
    {
        $category = CategorySands::findOrFail($this->categoryId);
        $category->description = $this->description;
        $category->save();
        $this->resetForm();
        $this->editMode = false;
    }

    public function delete($id)
    {
        $category = CategorySands::findOrFail($id);
        $category->delete();
    }
}
