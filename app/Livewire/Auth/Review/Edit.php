<?php

namespace App\Livewire\Auth\Review;

use App\Models\MenuItems;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use App\Models\Setting;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Edit extends Component
{
    public $text;
    public $id;
    public $review;
    public $settings;

    use WithFileUploads;

    public function mount()
    {
        $this->settings = Setting::first();

        $this->id = Route::current()->parameter('id');
        $this->review = \App\Models\Review::where('id', $this->id)->first();

        $this->text = $this->review->text;
    }



    public function render()
    {

        return view('livewire.auth.review.edit')->layout('components.layouts.adminapp');
    }

    public function update() {


        \App\Models\Review::where('id', $this->id)->update([
            'text' => $this->text,

        ]);

        session()->flash('success','De aanpassingen zijn opgeslagen');
        return $this->redirect('/auth/reviews', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/reviews', navigate: true);
    }
}
