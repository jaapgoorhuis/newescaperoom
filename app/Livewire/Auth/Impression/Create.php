<?php

namespace App\Livewire\Auth\Impression;

use App\Livewire\FrontEnd\PageBlockController;
use App\Models\MenuItems;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{

    public $order_id;
    public $title;
    public $impressionFile = [];

    public $impression;


    use WithFileUploads;

    protected $rules = [
        'title' => 'required|unique:menu',

    ];

    public function mount() {
        \App\Models\Impression::create([
            'title' => '',
        ]);
    }

    public function render()
    {
        $this->impression = \App\Models\Impression::orderBy('id', 'desc')->first();
        return view('livewire.auth.impression.create')->layout('components.layouts.adminapp');
    }

    public function store() {
        $this->validate();

        \App\Models\Impression::where('id', $this->impression->id)->update([
            'title' => $this->title,
        ]);


        $this->uploadFiles();


        session()->flash('success','De impressie is toegevoegd');
        return $this->redirect('/auth/impressions', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/impressions', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function validateUploadedFile() {
        return true;
    }

    public function revert() {
        return true;
    }


    public function uploadFiles() {
        if($this->impressionFile) {

            $files = collect($this->impressionFile);
            foreach($files as $file) {
                if(Storage::disk('tmp')->exists($file->getFileName())) {

                    $this->impression->addMedia($file->getRealPath())->toMediaCollection('impressions');
                }
            }
            $this->dispatch('updated');
        }
    }

}
