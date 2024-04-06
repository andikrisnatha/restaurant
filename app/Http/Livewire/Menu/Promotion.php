<?php

namespace App\Http\Livewire\Menu;

use App\Models\Promotion as ModelsPromotion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Promotion extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $imagePath, $title, $price, $description, $image, $status, $promotion_id;
    protected $promotions;

    public $isModalOpen = false;
    public $search = '';

    public $rules = [
        'title' => 'required',
        'price' => 'required',
        'description' => 'required',
        'status' => 'required',
    ];

    public $messages = [
        'title.required' => 'fill this out!!!',
        'price.required' => 'fill this out!!!',
        'description.required' => 'fill this out!!!',
        'status.required' => 'you must select one',
    ];

    public function render()
    {
        $this->promotions = ModelsPromotion::query()->search($this->search)->paginate(10);
        return view('livewire.menu.cms.promotions.promotion', [
            'promotions' => $this->promotions
        ]);
    }

    public function updateSelectedPromotionStatus($promotionId)
    {
        $promotion = ModelsPromotion::findOrFail($promotionId);
        $promotion->status = $promotion->status == 1 ? 0 : 1;
        $promotion->save();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetCreateForm()
    {
        $this->title = '';
        $this->price = '';
        $this->description = '';
        $this->image = '';
        $this->status = '';
    }

    public function store()
    {
        $this->validate();

        if ($this->promotion_id) {
            $oldPromotion = ModelsPromotion::findOrFail($this->sandsMenu_id);
            if($oldPromotion->image) {
                ModelsPromotion::disk('public')->delete('menu/promotion/' . $oldPromotion->image);
            }
        }

        $uniqueNumber = mt_rand(100, 99999);
        $cleanMainTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $this->title);
        $fileName = "";
        if ($this->image) {
            $fileName = $uniqueNumber . '_' . $cleanMainTitle . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/menu/promotion/', $fileName);
        }

        ModelsPromotion::updateOrCreate(['id' => $this->promotion_id], [
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $fileName,
            'status' => $this->status,
        ]);

        session()->flash('message', 'promotion added!');
        $this->resetCreateForm();
        $this->closeModal();
    }

    public function edit($id)
    {
        $promotion = ModelsPromotion::findOrFail($id);
        $this->title = $promotion->title;
        $this->price = $promotion->price;
        $this->description = $promotion->description;
        $this->imagePath = $promotion->image;
        $this->status = $promotion->status;

        $this->openModal();
    }

    public function delete($id)
    {
        $promotion = ModelsPromotion::findOrFail($id);
        if ($promotion->image) {
            Storage::disk('public')->delete('menu/promotion/' . $promotion->image);
        }

        ModelsPromotion::find($id)->delete();
        session()->flash('message', 'deleted!');
    }
}
