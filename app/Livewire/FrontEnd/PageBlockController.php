<?php

namespace App\Livewire\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Mail\Magazine;
use App\Mail\PostAdminMail;
use App\Mail\PostMail;
use App\Models\Color;
use App\Models\ColorCategory;
use App\Models\ColorFilterValue;
use App\Models\Filter;
use App\Models\MenuItems;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Livewire\Component;

class PageBlockController extends Component
{

    public $page;
    public $pageid;
    public $pageRoute;

    public $indexPage;

    public $slug;

    public $impressions;

    public $voornaam;
    public $achternaam;
    public $telefoonnummer;
    public $email;
    public $bericht;

    public $voornaam_contact;
    public $achternaam_contact;
    public $telefoonnummer_contact;
    public $email_contact;
    public $bericht_contact;
    public $privacy_contact;

    public $settings;
    public $privacy;

    public function index()
    {

    }

    public function indexImages() {

    }

    public function render()
    {

    $this->settings = Setting::first();
    $this->impressions = \App\Models\Impression::orderBy('order_id')->get();

    $this->page = Page::where('route', $this->slug)->first();
        if($this->page) {
            if ($this->slug == $this->page->route) {
                $this->page = Page::where('route', $this->slug)->first();

                $this->pageid = $this->page->id;
                $this->pageRoute = $this->page->route;
                $pageType = $this->page->page_type;

                return view('livewire.frontend.' . $pageType . '.' . $pageType)->layout('components.layouts.frontapp');
            } else if (!$this->slug) {

                return view('livewire.frontend.index.index')->layout('components.layouts.frontapp');
            }
        } else if($this->slug == '') {
            $this->slug = 'index';
            $this->page = Page::where('route', 'index')->first();
            $this->indexPage = Page::where('route', 'index')->first();
            return view('livewire.frontend.index.index')->layout('components.layouts.frontapp');
        } else {
            return view('livewire.frontend.notfound.notfound')->layout('components.layouts.frontapp');
        }
    }

    public function store(Request $request)
    {

        $uri = str_replace(env('APP_URL').'/', '', url()->previous());

        if($uri == '') {
            $pageid = Page::where('route', 'index')->first()->id;
        } else {
            $pageid = Page::where('route', $uri)->first()->id;
        }



        if(count($request->array)) {

            PageBlock::where('page_id', $request->pageId)->delete();
            foreach ($request->array as $key => $array) {
                PageBlock::create(
                    ['value' => $array, 'block_id' => $request->blockId[$key], 'order_id' => '0', 'page_id' => $pageid]
                );
            }
        }
    }

    public function storeImages(Request $request)
    {
        foreach($request->files as $file) {
            $file->move(public_path('storage/images/frontend/uploads'), $file->getClientOriginalName());
        }

    }


    public function rules() {
        return[
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required|email',
            'privacy' => 'accepted'
        ];
    }

    public function contactRules() {
        return[
            'voornaam_contact' => 'required',
            'achternaam_contact' => 'required',
            'email_contact' => 'required|email',
            'privacy_contact' => 'accepted'
        ];
    }


    public function phoneRule() {
        return[
            'telefoonnummer' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ];
    }

    public function storeMagazine() {
        $this->validate($this->rules());

        $array = [
            'voornaam' => $this->voornaam,
            'achternaam' => $this->achternaam,
            'email' => $this->email,
            'telefoonnummer' => $this->telefoonnummer
        ];

        Mail::to($this->email)
            ->send(new Magazine($array));

        session()->flash('success','Het magazine is verstuurd naar '.$this->email);

        $this->voornaam = '';
        $this->achternaam = '';
        $this->telefoonnummer = '';
        $this->email = '';
        $this->privacy = false;
    }

    public function storeContact() {

        $this->validate($this->contactRules());

        $array = [
            'voornaam' => $this->voornaam_contact,
            'achternaam' => $this->achternaam_contact,
            'email' => $this->email_contact,
            'telefoonnummer' => $this->telefoonnummer_contact,
            'bericht' => $this->bericht_contact
        ];

        Mail::to(env('MAIL_TO_ADDRESS'))
            ->send(new Contact($array));

        $this->dispatch('resetForm');
    }

    public function updateOrder($list) {
        foreach($list as $item) {
            PageBlock::where('block_id', $item['value'])->update(['order_id' => $item['order']]);
        }
    }
}

