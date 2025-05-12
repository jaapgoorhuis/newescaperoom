<?php

namespace App\Livewire\Auth\Setting;

use Livewire\Component;

class Setting extends Component
{
    public $settings;
    public $instagram;
    public $facebook;
    public $twitter;
    public $linkedIn;
    public $name;

public function mount() {

    $this->settings = \App\Models\Setting::first();

    $this->instagram = $this->settings->instagram;
    $this->facebook = $this->settings->facebook;
    $this->twitter = $this->settings->x;
    $this->linkedIn = $this->settings->linkedin;
    $this->name = $this->settings->name;
}
    public function render()
    {


        return view('livewire.auth.setting.setting')->layout('components.layouts.adminapp');
    }


    public function update() {


        $this->settings->update([
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedIn,
            'name' => $this->name,
        ]);
        session()->flash('success','Settings geupdate');

        return $this->redirect('/auth/settings', navigate: true);
    }



}
