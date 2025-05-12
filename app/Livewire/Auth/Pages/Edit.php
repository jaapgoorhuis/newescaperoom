<?php

namespace App\Livewire\Auth\Pages;

use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public $page;
    public $id;
    public $title;
    public $route;
    public $page_type;
    public $meta_title_nl;
    public $meta_title_de;
    public $meta_title_en;
    public $meta_description_nl;
    public $meta_description_de;
    public $meta_description_en;
    public $meta_keywords_nl;
    public $meta_keywords_de;
    public $meta_keywords_en;
    public $meta_robots;
    public $is_removable;
    public $is_active;
    public $header_image = [];
    public $show_header;
    public $show_footer;
    public $mediaItems;
    public $header_text;
    public $fileUploaded = false;

    use WithFileUploads;
    use WithFilePond;

    protected $rules = [
        'title' => 'required',
        'route' => 'required',
        'meta_description_nl' => 'max:155',
        'meta_description_de' => 'max:155',
        'meta_description_en' => 'max:155'
    ];


    public function mount() {
        $this->id = Route::current()->parameter('id');
        $this->page = Page::where('id', $this->id)->first();
        $this->title = $this->page->title;
        $this->route = $this->page->route;
        $this->page_type = $this->page->page_type;
        $this->is_removable = $this->page->is_removable;
        $this->is_active = $this->page->is_active;
        $this->header_text = $this->page->header_text;
        $this->show_footer = $this->page->show_footer; $this->mediaItems = $this->page->getMedia('files');
        $this->show_header = $this->page->show_header;
    }

    public function render()
    {
        $this->mediaItems = $this->page->getMedia('files');
        return view('livewire.auth.pages.edit')->layout('components.layouts.adminapp');
    }

    public function editPage() {
        $this->validate();

        Page::whereId($this->id)->update([
            'title' => $this->title,
            'route' => $this->route,
            'page_type' => $this->page_type,
            'is_removable' => $this->is_removable,
            'is_active' => $this->is_active,
            'show_footer' => $this->show_footer,
        ]);


        session()->flash('success','Pagina geupdate');

        return $this->redirect('/auth/pages', navigate: true);
    }
    public function cancelPage() {
        return $this->redirect('/auth/pages', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function removeExistingFiles($id) {

        foreach($this->mediaItems as $mediaitem) {
            if($mediaitem->id == $id) {
                $mediaitem->delete();
            }
        }
        $this->dispatch('pondReset');
    }

    #[On('uploadFiles')]
    public function uploadFiles() {
        $page = Page::orderBy('id', 'desc')->first();

        $mediaItems = $page->getMedia('files');


        foreach($mediaItems as $item) {
            $item->delete();
        }

        if(Storage::disk('tmp')->exists($this->header_image->getFileName())) {
            $page->addMedia($this->header_image->getRealPath())->withCustomProperties(['extension' => $this->header_image->getClientOriginalExtension()])->toMediaCollection('files');
        }

        $this->dispatch('updated');
    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }


}
