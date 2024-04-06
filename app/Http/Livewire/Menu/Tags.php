<?php

namespace App\Http\Livewire\Menu;

use App\Models\MenuTag;
use Livewire\Component;

class Tags extends Component
{
    public $title;
    public $menuTagId;
    public $editMode = false;

    public function render()
    {
        $menuTags = MenuTag::all();
        return view('livewire.menu.tags', compact('menuTags'));
    }

    public function store()
    {
        MenuTag::create($this->modelData() + ['slug' => str()->slug($this->title)]);
        $this->title = "";
    }

    public function delete($id)
    {
        $menuTag = MenuTag::findOrFail($id);
        $menuTag->delete();
    }

    public function edit($id)
    {
        $menuTag = MenuTag::findOrFail($id);
        $this->title = $menuTag->title;
        $this->menuTagId = $menuTag->id;
        $this->editMode = true;
    }

    public function update()
    {
        $menuTag = MenuTag::findOrFail($this->menuTagId);
        $menuTag->title = $this->title;
        $menuTag->slug = str()->slug($this->title);
        $menuTag->save();
        $this->title = "";
        $this->id = "";
        $this->editMode = false;
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
        ];
    }

}
