<?php

namespace App\Livewire\Auth\Review;

use App\Models\MenuItems;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        return view('livewire.auth.review.delete')->layout('components.layouts.adminapp');
    }

    public function cancel() {
        return $this->redirect('/auth/reviews', navigate: true);
    }

    public function remove()
    {
        \App\Models\Review::find($this->id)->delete();

        session()->flash('success',"De review is verwijderd");

        return $this->redirect('/auth/reviews', navigate: true);
    }
}
