<?php

namespace App\Livewire\Auth\Menu;

use App\Models\MenuItems;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Edit extends Component
{
    public $page_id;
    public $pages;
    public $show_footer;
    public $show_menu;
    public $title;
    public $id;
    public $menu_item;

    use WithFileUploads;

    public function mount() {
        $this->id = Route::current()->parameter('id');
        $this->pages = Page::get();
        $this->menu_item = MenuItems::where('id', $this->id)->first();
        $this->page_id = $this->menu_item->page_id;
        $this->show_footer = $this->menu_item->show_footer;
        $this->title = $this->menu_item->title;
        $this->show_menu = $this->menu_item->show_menu;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2|unique:menu,title,' . $this->id,
        ];
    }

    public function render()
    {

        return view('livewire.auth.menu.edit')->layout('components.layouts.adminapp');
    }

    public function updateMenu() {
        $this->validate($this->rules());

        MenuItems::where('id', $this->id)->update([
            'title' => $this->title,
            'page_id' => $this->page_id,
            'order_id' => $this->menu_item->order_id,
            'parent_id' => '0',
            'is_dropdown_parent' => '0',
            'show_footer' => $this->show_footer,
            'show_menu' => $this->show_menu,
        ]);

        session()->flash('success','De aanpassingen zijn opgeslagen');
        return $this->redirect('/auth/menu', navigate: true);
    }

    public function cancelMenu() {
        return $this->redirect('/auth/menu', navigate: true);
    }
}
