<?php

namespace App\Http\Livewire\Menu;

use App\Models\BeverageTag;
use App\Models\MenuTag;
use Livewire\Component;

class BeverageTags extends Component
{

    public $title, $beverageTagId;
    public $editMode = false;


    public function render()
    {
        $beverageTags = BeverageTag::all();
        return view('livewire.menu.cms.beverage.tags.beverage-tags', compact('beverageTags'));
    }

    public function store()
    {
        BeverageTag::create($this->modelData() + ['slug' => str()->slug($this->title)]);
        $this->title = '';
    }

    public function edit($id)
    {
        $menuTag = MenuTag::findOrFail($id);
        $this->title = $menuTag->title;
        $this->beverageTagId = $menuTag->id;
        $this->editMode = true;
    }

    public function update()
    {
        $beverageTag = BeverageTag::findOrFail($this->menuTagId);
        $beverageTag->title = $this->title;
        $beverageTag->slug  = str()->slug($this->title);
        $beverageTag->save();
        $this->editMode = false;
        $this->title = '';
        $this->id = '';
    }

    public function delete($id)
    {
        $beverageTag = BeverageTag::findOrFail($id);
        $beverageTag->delete();
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
        ];
    }
}
