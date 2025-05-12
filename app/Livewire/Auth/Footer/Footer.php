<?php

namespace App\Livewire\Auth\Footer;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Footer extends Component
{
    public $type_column_1;
    public $type_column_2;
    public $type_column_3;
    public $type_column_4;

    public $column_1_text;
    public $column_2_text;
    public $column_3_text;
    public $column_4_text;
    public $column_1_image;
    public $column_2_image;
    public $column_3_image;
    public $column_4_image;

    public $text_column_5;


    public $column_1;
    public $column_2;
    public $column_3;
    public $column_4;
    public $footerItem;

    public $show_magazine;

    public $settings;

    use WithFileUploads;


    public function mount() {

        $this->settings = Setting::first();

        $this->footerItem = \App\Models\Footer::first();

        if(!$this->footerItem) {
            \App\Models\Footer::create();
        }

        for($i =1; $i <5; $i++) {
            $indicater = 'type_column_' . $i;
            $column = 'column_'.$i;
            $typeColumn = 'column_' . $i . '_type';
            $this->$indicater = $this->footerItem->$typeColumn;
            $this->$column = $this->footerItem->$column;
        }



        if($this->footerItem->show_magazine == null) {
            $this->show_magazine = '0';
        }else {
            $this->show_magazine = $this->footerItem->show_magazine;
        }

    }

    public function resetExistingImage($id) {

        $column = 'column_'.$id;
        $this->$column = '';
    }

    public function render()
    {

        return view('livewire.auth.footer.footer')->layout('components.layouts.adminapp');
    }



    public function rules() {
        return [

        ];
    }

    public function toggleColumnSelector() {
        $this->dispatch('refresh');
    }

    public function update(Request $request) {

        for($i =1; $i <5; $i++) {
            $indicater = 'type_column_'.$i;
            $column = 'column_'.$i;
            $typeColumn = 'column_'.$i.'_type';
            $imageColumn = 'column_'.$i.'_image';
            $textColumn = 'column_'.$i.'_text';

            if ($this->$indicater == 'text') {

                \App\Models\Footer::find(1)->update([$column => $this->$textColumn, $typeColumn => 'text']);
            }
            if ($this->$indicater == 'image') {
                if(!$this->$column && !$this->$imageColumn) {
                    $this->validate([$imageColumn => 'required']);
                }
                if($this->$imageColumn) {
                    $extension = $this->$imageColumn->getClientOriginalExtension();
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                        $this->$imageColumn->storeAs('/', $this->$imageColumn->getClientOriginalName(), options: 'footer');
                        \App\Models\Footer::find(1)->update([
                            $column => '<img src="' . asset("storage/images/frontend/uploads/footer/" . $this->$imageColumn->getClientOriginalName()) . '" class="footer-image"/>',
                            $typeColumn => 'image']);
                    } else {
                        session()->flash('error', 'Alleen png, jpg en jpeg afbeeldingen zijn toegestaan');
                        return $this->redirect('/auth/footer', navigate: true);
                    }
                }
            }
        }

        \App\Models\Footer::find(1)->update(['show_magazine' => $this->show_magazine]);

        session()->flash('success','Footer geupdate');

        return $this->redirect('/auth/footer', navigate: true);
    }


}
