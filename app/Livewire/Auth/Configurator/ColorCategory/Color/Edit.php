<?php

namespace App\Livewire\Auth\Configurator\ColorCategory\Color;

use App\Models\ColorCategory;
use App\Models\ColorFilterValue;
use App\Models\FilterValue;
use App\Models\MenuItems;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public $color_id;
    public $color;
    public $title;
    public $color_code;

    public $color_filter = [];
    public $existing_color_images = [];
    public $color_images = [];

    public $colorCategory_id;
    public $structure_filter;

    public $existingStructureFilters;

    use WithFileUploads;

    public function mount($slug, $id) {
        $this->structure_filter = FilterValue::where('filter_id', 1)->get();
        $this->structure_filter = FilterValue::where('filter_id', 1)->get();
        $this->color_id = $slug;
        $this->existingStructureFilters = ColorFilterValue::where('color_id', $this->color_id)->get();
        $this->colorCategory_id = $id;
        $this->color = \App\Models\Color::where('id', $slug)->first();
        $this->title = $this->color->title;
        $this->color_code = $this->color->code;
        foreach($this->existingStructureFilters as $filters) {
            array_push($this->color_filter,$filters->filter_value_id);
        }
    }

    protected $rules = [
        'title' => 'required',
    ];

    public function render()
    {

        $this->existing_color_images = $this->color->getMedia('color_images');

        return view('livewire.auth.configurator.colorCategories.color.edit')->layout('components.layouts.adminapp');
    }

    public function storeColor() {
        $this->validate();
        $this->color->update([
            'title' => $this->title,
            'color_code' => $this->color_code
        ]);

        ColorFilterValue::where('color_id', $this->color->id)->delete();

        foreach($this->color_filter as $filter) {
            ColorFilterValue::create(['filter_value_id' => $filter, 'color_id' => $this->color->id]);
        }

        $this->uploadFiles();
        session()->flash('success','De kleur is toegevoegd');
        return $this->redirect('/auth/configurator/colorCategories/'.$this->colorCategory_id.'/color', navigate: true);
    }

    public function cancelColor() {
        return $this->redirect('/auth/configurator/colorCategories/'.$this->colorCategory_id.'/color', navigate: true);
    }
    public function updateImageOrder($list) {
        foreach($list as $item) {
            Media::where('id', $item['value'])->update(['order_column' => $item['order']]);
        }
        $this->dispatch('updated');
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function removeExistingFiles($id) {

        Media::where('id', $id)->delete();

    }

    public function uploadFiles() {
        if($this->color_images) {


            $files = collect($this->color_images);
            foreach($files as $file) {
                if(Storage::disk('tmp')->exists($file->getFileName())) {
                    $this->color->addMedia($file->getRealPath())->toMediaCollection('color_images');
                }
            }
            $this->dispatch('updated');
            $this->dispatch('pondCompleteReset');
        }
    }
    public function validateUploadedFile() {
        return true;
    }

    public function revert() {
        return true;
    }

}
