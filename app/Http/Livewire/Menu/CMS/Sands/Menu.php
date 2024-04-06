<?php

namespace App\Http\Livewire\Menu\CMS\Sands;

use App\Models\CategorySands;
use App\Models\MenuTag;
use App\Models\SandsMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;


class Menu extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    protected $menus;
    public $categories, $sandsMenu_id, $user_id, $sandsMenu, $tags;
    public $main_title, $description, $title_1, $title_2, $title_3, $title_4, $price_1, $price_2, $price_3, $price_4, $image, $imagePath, $video_url, $category_sands_id, $status;
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
        'category_sands_id' => 'required',
        'tag_ids' => 'required',
        'status' => 'required',
    ];
    
    public $messages = [
        'main_title.required' => 'fill this out!!!',
        'description.required' => 'fill this out!!!',
        'price_1.required' => 'fill this out!!!',
        // 'image.required' => 'Image file max 10Mb',
        'category_sands_id.required' => 'Must select One',
        'tag_ids.required' => 'fill this out!!!',
        'status.required' => 'fill this out!!!',
    ];
    
    public function render()
    {
        
        $this->menus = SandsMenu::query()
        ->search($this->search)
        ->orderBy('id', 'DESC')
        ->paginate(7);
        $this->categories = CategorySands::all();
        $this->tags = MenuTag::all();
        
        return view('livewire.menu.cms.sands.index', [
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
    
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetCreateForm();
    }
    
    public function resetCreateForm()
    {
        $this->id = '';
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
        $this->category_sands_id = '';
        $this->status = '';
        $this->tag_ids = [];
        $this->selected_tags = [];
    }
    
    
    public function store()
    {
        $this->validate();
        
        // Find the SandsMenu if it exists, or create a new one
        $menu = SandsMenu::updateOrCreate(['id' => $this->sandsMenu_id], [
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
            'category_sands_id' => $this->category_sands_id,
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
        session()->flash('message', $this->sandsMenu_id ? 'Menu Updated.' : 'Menu Created.');
    }
    
    
    public function edit($id)
    {
        $sandsMenu = SandsMenu::findOrFail($id);
        $this->sandsMenu_id = $id;
        $this->main_title = $sandsMenu->main_title;
        $this->description = $sandsMenu->description;
        $this->title_1 = $sandsMenu->title_1;
        $this->title_2 = $sandsMenu->title_2;
        $this->title_3 = $sandsMenu->title_3;
        $this->title_4 = $sandsMenu->title_4;
        $this->price_1 = $sandsMenu->price_1;
        $this->price_2 = $sandsMenu->price_2;
        $this->price_3 = $sandsMenu->price_3;
        $this->price_4 = $sandsMenu->price_4;
        $this->imagePath = $sandsMenu->image;
        $this->video_url = $sandsMenu->video_url;
        $this->category_sands_id = $sandsMenu->category_sands_id;
        $this->status = $sandsMenu->status;
        $this->tag_ids = $sandsMenu->tags->map(function($tag) {
            return $tag->id;
        });
        $this->selected_tags = $this->tag_ids;
        
        $this->openModal();
        
    }
    
    public function updateSelectedMenuStatus($menuId)
    {
        $menu = SandsMenu::findOrFail($menuId);
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
            'category_sands_id' => $this->category_sands_id,
            'tag_ids' => $this->tag_ids,
            'status' => $this->status,
        ];
    }
    
    public function delete($id)
    {
        $menu = SandsMenu::findOrFail($id);
        if ($menu->image) {
            Storage::disk('public')->delete('menu/' . $menu->image);
        }
        
        $menu->delete();
        session()->flash('message', 'Deleted');
    }
}
