<?php

namespace App\Livewire\Auth\Review;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Review extends Component
{
    public $reviews;

    public $settings;


    use WithFileUploads;


    public function render()
    {
        $this->settings = Setting::first();
        $this->reviews = \App\Models\Review::orderBy('order_id', 'asc')->get();
        return view('livewire.auth.review.review')->layout('components.layouts.adminapp');
    }

    public function create() {
        return $this->redirect('/auth/reviews/create', navigate: true);
    }

    public function edit($id) {
        return $this->redirect('/auth/reviews/edit/'.$id, navigate: true);
    }

    public function updateOrder($list) {
        foreach($list as $item) {
            \App\Models\Review::where('id', $item['value'])->update(['order_id' => $item['order']]);
        }
    }


    public function delete($id) {

        return $this->redirect('/auth/reviews/delete/'.$id, navigate: true);
    }


}
