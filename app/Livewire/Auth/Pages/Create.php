<?php

namespace App\Livewire\Auth\Pages;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public $page;
    public $title;
    public $route;
    public $page_type = 'pagebuilder';
    public $is_removable = '1';
    public $is_active = '1';
    public $header_image;
    public $show_header = '1';
    public $mediaItems;
    public $show_footer = '1';
    public $header_text;

    use WithFilePond;
    use WithFileUploads;

    protected $rules = [
        'title' => 'required',
        'route' => 'required',
    ];

    public function render()
    {


        return view('livewire.auth.pages.create')->layout('components.layouts.adminapp');
    }

    public function storePage() {
        $this->validate();
        Page::create([
            'title' => $this->title,
            'route' => $this->route,
            'page_type' => $this->page_type,
            'is_removable' => $this->is_removable,
            'is_visible' => '1',
            'is_active' => $this->is_active,
            'show_footer' => $this->show_footer,
        ]);

        $this->uploadFiles();
        session()->flash('success','Pagina toegevoegd');

        return $this->redirect('/auth/pages', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function uploadFiles() {
        if($this->header_image) {

            $page = Page::orderBy('id', 'desc')->first();
            if (Storage::disk('tmp')->exists($this->header_image->getFileName())) {
                $page->addMedia($this->header_image->getRealPath())->toMediaCollection();
            }

            $uploadedFiles = Media::where('model_id', $page->id)->get();
            foreach ($uploadedFiles as $media) {
                if ($media->friendly_name == '') {
                    Media::where('id', $media->id)->update([
                        'friendly_name' => $media->name,
                    ]);
                }
            }

            $this->dispatch('updated');
        }
    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }

    public function cancelPage() {
        return $this->redirect('/auth/pages', navigate: true);
    }

    public function removeHeaderImage () {
        $this->tumbnail = '';
    }

}
