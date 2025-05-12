<?php

namespace App\Livewire\Auth\Magazine;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Magazine extends Component
{
    public $id;
    public $magazine;
    public $text;
    public $settings;

    public $magazine_image =[];
    public $existing_magazine_image;

    use WithFilePond;
    use WithFileUploads;

public function mount() {
    $this->magazine = \App\Models\Magazine::first();

    $this->settings = Setting::first();

    if(!$this->magazine) {
        \App\Models\Magazine::create();
    }

    $this->text = $this->magazine->text;
}
    #[On('refresh-the-component')]
    public function render()
    {
        $this->existing_magazine_image = $this->magazine->getMedia('magazine');

        return view('livewire.auth.magazine.magazine')->layout('components.layouts.adminapp');
    }


    public function update() {


        $this->magazine->update([
            'text' => $this->text,
        ]);
        session()->flash('success','Setting geupdate');

        return $this->redirect('/auth/magazine', navigate: true);
    }

    public function removeExistingFiles($id) {
        Media::where('id', $id)->delete();
        $this->dispatch('pondReset');
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {

        Media::where('file_name',$filename)->delete();

    }

    public function uploadFiles() {
        if($this->magazine_image) {


            $mediaItems = $this->magazine->getMedia('magazine');
            foreach ($mediaItems as $mediaitem) {
                $mediaitem->delete();
            }

            $files = collect($this->magazine_image);
            foreach($files as $file) {
                if(Storage::disk('tmp')->exists($file->getFileName())) {
                    $this->magazine->addMedia($file->getRealPath())->toMediaCollection('magazine');
                }
            }
            $this->dispatch('refresh-the-component');

        }
    }
    public function validateUploadedFile() {
        return true;
    }

    public function revert() {
        return true;
    }
}
