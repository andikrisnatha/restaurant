<?php

namespace App\Http\Livewire\Menu\Cms\Beverage;

use App\Models\Beverage as ModelsBeverage;
use App\Models\BeverageTag;
use App\Models\CategoryBeverage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Beverage extends Component
{
    
    use WithPagination;
    use WithFileUploads;
    
    protected $beverages;
    protected $menus;
    public $categories, $user_id, $beverage_id, $beverage, $tags;
    public $main_title, $description, $price_bottle, $price_glass, $image, $category_beverages_id, $status;
    
    public $tag_ids = [];
    public $selected_tags = [];
    public $isMenu = true;
    public $isModalOpen = false;
    public $isCategory = false;
    public $isTags = false;

    public $search = '';
    
    public function clearSearch()
    {
        $this->search = '';
    }

    public function resetToggle() {
        $this->isTags = false;
        $this->isCategory = false;
        $this->isMenu = false;
    }

    public function openCategory()
    {
        $this->resetToggle();
        $this->isCategory = true;
    }

    public function openTags()
    {
        $this->resetToggle();
        $this->isTags = true;
    }

    public function openMenu()
    {
        $this->resetToggle();
        $this->isMenu = true;
    }
    
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
    
    public function render()
    {
        $this->beverages = ModelsBeverage::paginate(10);
        $this->categories = CategoryBeverage::all();
        $this->tags = BeverageTag::all();

        return view('livewire.menu.cms.beverage.index', [
            'beverages' => $this->beverages,
            'categories' => $this->categories
        ]);
    }
    
    public function resetCreateForm()
    {
        $this->id = '';
        $this->main_title = '';
        $this->price_glass = null;
        $this->price_bottle = null;
        $this->description = '';
        $this->category_beverages_id = '';
        $this->status = '';
        $this->status = '';
        $this->selected_tags = [];
        $this->tag_ids = [];
    }

    protected $rules = [
        'main_title' => 'required',
        'price_glass' => 'required',
        'category_beverages_id' => 'required',
        'status' => 'required',
        'tag_ids' => 'required',
        'description' => 'required',
        'price_bottle' => 'nullable' //allow null
    ];
    public $messages = [
        'main_title.required' => 'fill this out!!',
        'price_glass.required' => 'fill this out!!',
        'category_beverages_id.required' => 'Must select one!!',
        'status.required' => 'must select one!!',
        'tag_ids.required' => 'fill this out!!!',
        'description.required' => 'fill this out!!',
    ];
    
    
    public function store()
    {
        $this->validate();

        $priceBottle = $this->price_bottle ?: null;
        
        // Find the SandsMenu if it exists, or create a new one
        $menu = ModelsBeverage::updateOrCreate(['id' => $this->beverage_id], [
            'main_title' => $this->main_title,
            'user_id' => Auth::id(),
            'description' => $this->description,
            'price_glass' => $this->price_glass,
            'price_bottle' => $priceBottle,
            'category_beverages_id' => $this->category_beverages_id,
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
            $this->image->storeAs('public/menu/', $fileName);
            
            // Update the SandsMenu with the new image filename
            $menu->image = $fileName;
            $menu->save();
        }
        
        // Clear the form and close the modal
        $this->resetCreateForm();
        $this->closeModal();
        
        // Show a success message
        session()->flash('message', $this->beverage_id ? 'Menu Updated.' : 'Menu Created.');
    }

    public function edit($id)
    {
        $beverage = ModelsBeverage::findOrFail($id);
        $this->beverage_id = $id;
        $this->main_title = $beverage->main_title;
        $this->description = $beverage->description;
        $this->price_bottle = $beverage->price_bottle;
        $this->price_glass = $beverage->price_glass;
        $this->status = $beverage->status;
        $this->category_beverages_id = $beverage->category_beverages_id;
        $this->tag_ids = $beverage->tags->map(function($tag) {
            return $tag->id;
        });
        $this->selected_tags = $this->tag_ids;

        $this->openModal();
    }

    public function updateSelectedBeverageStatus($id)
    {
        $beverage = ModelsBeverage::findOrFail($id);
        $beverage->status = $beverage->status == 1 ? 0 : 1;
        $beverage->save();
    }

    public function modelData()
    {
        return [
            'main_title' => $this->main_title,
            'description' => $this->description,
            'price_bottle' => $this->price_bottle,
            'price_glass' => $this->price_glasse,
            'status' => $this->status,
            'category_beverage_id' => $this->category_beverages_id,
            'status' => $this->status,
            'tag_ids' => $this->tag_ids,
        ];
    }

    public function delete($id)
    {
        $beverage = ModelsBeverage::findorFail($id);
        if ($beverage->image) {
            Storage::disk('public')->delete('menu/beverage/' . $beverage->image);
        }

        $beverage->delete();
        session()->flash('message', 'deleted!');
    }
    
    
}
