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

class Create extends Component
{
    public $text;
    public $settings;

    public function render()
    {
        $this->settings = Setting::first();
        return view('livewire.auth.review.create')->layout('components.layouts.adminapp');
    }

    public function store() {
        \App\Models\Review::create([
            'text' => $this->text,

        ]);

        session()->flash('success','De review is toegevoegd');
        return $this->redirect('/auth/reviews', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/reviews', navigate: true);
    }
}
