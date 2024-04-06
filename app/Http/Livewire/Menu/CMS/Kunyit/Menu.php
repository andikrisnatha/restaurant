<?php

namespace App\Http\Livewire\Menu\Cms\Kunyit;

use App\Models\CategoryKunyit;
use App\Models\KunyitMenu;
use App\Models\MenuTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Menu extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $menus;
    public $categories, $kunyitMenu_id, $user_id, $kunyitMenu, $tags,  $menuId;
    public $main_title, $description, $title_1, $title_2, $title_3, $title_4, $price_1, $price_2, $price_3, $price_4, $image, $imagePath, $video_url, $category_kunyit_id, $status;
    public $tag_ids = [];
    public $selected_tags = [];

    public $isModalOpen = false;
    public $isMenu = true;
    public $isCategory = false;
    public $isBoard = false;

    public $search = '';

    public function openCategory()
    {
        $this->isMenu = false;
        $this->isBoard = false;
        $this->isCategory = true;
    }
    public function openMenu()
    {
        $this->isMenu = true;
        $this->isBoard = false;
        $this->isCategory = false;
    }
    public function openBoard()
    {
        $this->isMenu = false;
        $this->isBoard = true;
        $this->isCategory = false;
    }


    protected $rules = [
        'main_title' => 'required',
        'description' => 'required',
        'price_1' => 'required',
        // 'image' => 'image|max:1024',
        'category_kunyit_id' => 'required',
        'tag_ids' => 'required',
        'status' => 'required',
    ];

    public $messages = [
        'main_title.required' => 'fill this out!!!',
        'description.required' => 'fill this out!!!',
        'price_1.required' => 'fill this out!!!',
        // 'image.required' => 'Image file max 10Mb',
        'category_kunyit_id.required' => 'Must select One',
        'tag_ids.required' => 'fill this out!!!',
        'status.required' => 'fill this out!!!',
    ];

    public function render()
    {

        $this->menus = KunyitMenu::query()
        ->search($this->search)
        ->orderBy('id', 'DESC')
        ->paginate(7);
        $this->categories = CategoryKunyit::all();
        $this->tags = MenuTag::all();

        return view('livewire.menu.cms.kunyit.index', [
            'menus' => $this->menus,
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function confirmDelete($menuId)
    {
        $this->menuId = $menuId;
        $this->dispatchBrowserEvent('show-confirm-modal');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetCreateForm();
    }

    public function resetCreateForm()
    {
        $this->main_title = '';
        $this->description = '';
        $this->title_1 = '';
        $this->title_2 = '';
        $this->title_3 = '';
        $this->title_4 = '';
        $this->price_1 = '';
        $this->price_2 = null;
        $this->price_3 = null;
        $this->price_4 = null;
        // $this->image = '';
        $this->video_url = '';
        $this->category_kunyit_id = '';
        $this->status = '';
        $this->tag_ids = [];
        $this->selected_tags = [];
    }


    public function store()
    {
        $this->validate();

        // Find the SandsMenu if it exists, or create a new one
        $menu = KunyitMenu::updateOrCreate(['id' => $this->kunyitMenu_id], [
            'main_title' => $this->main_title,
            'user_id' => Auth::id(),
            'description' => $this->description,
            'title_1' => $this->title_1,
            'title_2' => $this->title_2,
            'title_3' => $this->title_3,
            'title_4' => $this->title_4,
            'price_1' => $this->price_1,
            'price_2' => $this->price_2,
            'price_3' => $this->price_3,
            'price_4' => $this->price_4,
            'video_url' => $this->video_url,
            'category_kunyit_id' => $this->category_kunyit_id,
            'status' => $this->status,
        ]);

        // Sync the tags for the SandsMenu
        $menu->tags()->sync($this->tag_ids);

        // Check if a new image is uploaded
        if ($this->image) {
            // Delete the old image if it exists
            if ($menu->image) {
                Storage::disk('public')->delete('menu/' . $menu->image);
            }

            // Generate a new unique filename for the uploaded image
            $uniqueNumber = mt_rand(100000, 999999999);
            $cleanMainTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $this->main_title);
            $fileName = $uniqueNumber . '_' . $cleanMainTitle . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/menu', $fileName);

            // Update the SandsMenu with the new image filename
            $menu->image = $fileName;
            $menu->save();
        }

        // Clear the form and close the modal
        $this->resetCreateForm();
        $this->closeModal();

        // Show a success message
        session()->flash('message', $this->kunyitMenu_id ? 'Menu Updated.' : 'Menu Created.');
    }

    public function edit($id)
    {
        $kunyitMenu = KunyitMenu::findOrFail($id);
        $this->kunyitMenu_id = $id;
        $this->main_title = $kunyitMenu->main_title;
        $this->description = $kunyitMenu->description;
        $this->title_1 = $kunyitMenu->title_1;
        $this->title_2 = $kunyitMenu->title_2;
        $this->title_3 = $kunyitMenu->title_3;
        $this->title_4 = $kunyitMenu->title_4;
        $this->price_1 = $kunyitMenu->price_1;
        $this->price_2 = $kunyitMenu->price_2;
        $this->price_3 = $kunyitMenu->price_3;
        $this->price_4 = $kunyitMenu->price_4;
        $this->imagePath = $kunyitMenu->image;
        $this->video_url = $kunyitMenu->video_url;
        $this->category_kunyit_id = $kunyitMenu->category_kunyit_id;
        $this->status = $kunyitMenu->status;
        $this->tag_ids = $kunyitMenu->tags->map(function($tag) {
            return $tag->id;
        });
        $this->selected_tags = $this->tag_ids;

        $this->openModal();

    }

    public function updateSelectedMenuStatus($menuId)
    {
        $menu = KunyitMenu::findOrFail($menuId);
        $menu->status = $menu->status == 1 ? 0 : 1;
        $menu->save();

    }

    public function modelData()
    {
        return [
            'main_title' => $this->main_title,
            'description' => $this->description,
            'title_1' => $this->title_1,
            'title_2' => $this->title_2,
            'title_3' => $this->title_3,
            'title_4' => $this->title_4,
            'price_1' => $this->price_1,
            'price_2' => $this->price_2,
            'price_3' => $this->price_3,
            'price_4' => $this->price_4,
            'image' => $this->image,
            'video_url' => $this->video_url,
            'category_kunyit_id' => $this->category_kunyit_id,
            'tag_ids' => $this->tag_ids,
            'status' => $this->status,
        ];
    }

    public function delete($id)
    {
        $menu = KunyitMenu::findOrFail($id);
        if ($menu->image) {
            Storage::disk('public')->delete('menu/' . $menu->image);
        }

        $menu->delete();
        session()->flash('message', 'Deleted');
    }
}
