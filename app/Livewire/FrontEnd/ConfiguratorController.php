<?php

namespace App\Livewire\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\PostAdminMail;
use App\Mail\PostMail;
use App\Models\Color;
use App\Models\ColorCategory;
use App\Models\ColorFilterValue;
use App\Models\Filter;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use Livewire\Component;

class ConfiguratorController extends Component
{


    public $slug;
    public $pages;
    public $page;
    public $pageid;
    public $pageRoute;
    public $indexPage;

    public $showSuccesOfferte;
    public $showSuccesBestelling;

    //configurator variables
    public $enkelDubbel;
    public $typeDeur;
    public $hoogte;
    public $breedte;
    public $draairichting;

    public $modelDoor;

    public $colorSampleOrDefColor;

    public $glas;
    public $greep;

    public $greepOption;

    public $monteren;
    public $zelfMonteren;

    public $inmeten;

    public $bezorgen;

    //end configurator variables

    public $colors = [];
    public $color_ids = [];
    public $categoryColors;
    public $collectionTitle;

    public $showCollections = true;
    public $showCollectionColors = false;
    public $showHideBezorgen;
    public $showColorFilter = false;
    public $hideGreep;
    public $filter_value = [];
    public $filter_ids = [];
    public $filtersSelected = false;
    public $filter_title = "Gefilterde kleuren";
    public $color_choise = [];

    public $showDraairichting;

    public $filters;

    public $voornaam;
    public $achternaam;
    public $email;
    public $telefoon;
    public $straat;
    public $postcode;
    public $plaats;
    public $land;
    public $bericht;

    public $acceptConditions;
    public $acceptPayConditions;

    public $typeGreep;

    public $showKlink;
    public $showGreep;

    public $greepColor;

    public $scharnier;

    public $imageDubbelEnkel;

    public $imageLinksRechts;

    public $imageGlas;
    public $afhalen;

    public $imageTypeDeur;
    public $settings;

    public function render()
    {
        $this->dispatch('updateLigtbox');
        $this->enkelDubbel = session('enkelDubbel', 'Enkele deur');
        $this->settings = Setting::first();

        //tab1
        $this->typeDeur = session('typeDeur', 'Taatsdeur');

        if($this->enkelDubbel == 'Enkele deur') {
            $this->showDraairichting = true;
        } else {
            if($this->typeDeur != 'Draaideur') {
                $this->showDraairichting = false;
            } else {

                $this->showDraairichting = true;
            }
        }


        $this->hoogte = session('hoogte', '211.5');
        $this->breedte = session('breedte', '93');
        $this->draairichting = session('draairichting', 'Links');

        //tab 2

        $this->modelDoor = session('modelDoor', 'model1');
        $this->colorSampleOrDefColor = session('colorSampleOrDefColor', 'Sample');
        $this->color_choise = session('color_choise', []);
        $this->glas = session('glas', 'Transparant');

        //tab3
        $this->greepOption = session('greepOption', false);
        $this->greepColor = session('greepColor', 'Rvs');
        $this->typeGreep = session('typeGreep', 'Greep');
        $this->scharnier = session('scharnier', 'Zichtbaar');

        if($this->greepOption) {
            $this->hideGreep = false;
        } else {
            $this->hideGreep = true;
        }

        $this->greep = session('greep', '35cm');

        //tab4
        $this->inmeten = session('inmeten', false);
        $this->monteren = session('monteren', false);
        $this->zelfMonteren = session('zelfMonteren', true);
        $this->bezorgen = session('bezorgen', false);
        $this->afhalen = session('afhalen', true);


        //tab5
        $this->voornaam = session('voornaam');
        $this->achternaam = session('achternaam');
        $this->email = session('email');
        $this->telefoon = session('telefoon');
        $this->straat = session('straat');
        $this->postcode = session('postcode');
        $this->plaats = session('plaats');
        $this->land = session('land', 'Nederland');
        $this->bericht = session('bericht');

        if($this->monteren) {
            $this->inmeten = true;
            $this->showHideBezorgen = false;
        } else {
            $this->showHideBezorgen = true;
        }

        if($this->zelfMonteren) {
            $this->showHideBezorgen = true;
        } else {
            $this->showHideBezorgen = false;
        }

        $this->imageLinksRechts = session('imageLinksRechts', 'links-');
        $this->imageDubbelEnkel = session('imageDubbelEnkel', 'enkel-');
        $this->imageGlas = session('imageGlas', 'helder-');
        $this->imageTypeDeur = session('imageTypeDeur', 'taats-');

        $this->pages = Page::get();
        $this->filters = Filter::orderBy('order_id', 'asc')->get();
        $this->categoryColors = ColorCategory::get();

        $this->page = Page::where('route', 'offerte-aanvragen')->first();

        if($this->page) {
             $this->pageid = $this->page->id;
            $this->pageRoute = $this->page->route;
            $pageType = $this->page->page_type;
                return view('livewire.frontend.index.index')->layout('components.layouts.frontapp');
            }
    }



    public function clickedCollection($id) {

        $this->collectionTitle = ColorCategory::find($id)->title;
        $this->colors = Color::where('color_category_id', $id)->get();
        $this->showCollections = false;
        $this->showCollectionColors = true;

    }

    public function backToCollections() {

        $this->showCollections = true;
        $this->showCollectionColors = false;
    }

    public function filterSelection($request) {

        $this->filter_ids = [];
        $this->color_ids = [];
        foreach($this->filter_value as $value) {
            array_push($this->filter_ids,$value);
        }

        $colorFilterValues = ColorFilterValue::get();
        foreach($colorFilterValues as $colorFilterValue) {
            if(in_array($colorFilterValue->filter_value_id, $this->filter_ids)) {
                array_push($this->color_ids, $colorFilterValue->color_id);
            }
        }

        if(count($this->filter_ids) !== 0) {
            $this->filtersSelected = true;
            if(count($this->color_ids) !== 0) {
                $this->filter_title = "Gefilterde resultaten";
            } else {
                $this->filter_title = "Geen resultaten gevonden";
            }
            $this->showColorFilter = true;
            $this->showCollections = false;
            $this->showCollectionColors = false;
        }
        else {
            $this->filtersSelected = false;
            $this->showColorFilter = false;
            $this->showCollections = true;
            $this->showCollectionColors = false;
        }

        $this->colors = Color::whereIn('id', $this->color_ids)->get();
    }

    public function eraseFilters() {
        $this->color_ids = [];
        $this->filter_ids = [];
        $this->filtersSelected = false;
        $this->showColorFilter = false;
        $this->showCollections = true;
        $this->showCollectionColors = false;

        $this->dispatch('updateFilter');
    }

    public function setColor($result) {
        if (!in_array($result, $this->color_choise)) {
            if (count($this->color_choise) < 3) {
                session()->push('color_choise', $result);
            }
        }
    }

    public function setColorSampleOrDefColor($result) {
        session(['colorSampleOrDefColor' => $result]);
    }

    public function setTypeDoor($result) {

        if($result != 'Draaideur') {
            session(['typeGreep' => 'Greep']);
        }

        session(['typeDeur' => $result]);
    }

    public function setHoogte() {
        session(['hoogte' => $this->hoogte]);

    }

    public function setBreedte() {
        session(['breedte' => $this->breedte]);

    }

    public function setDoorGlass($request) {
        if($request == 'Transparant') {
            session(['imageGlas' => 'helder-']);
        }
        if($request == 'Grijs') {
            session(['imageGlas' => 'grijs-']);
        }
        if($request == 'Brons') {
            session(['imageGlas' => 'brons-']);
        }
        session(['glas' => $request]);
    }

    public function setDraairichting() {
        if($this->draairichting) {
            session(['imageLinksRechts' => 'rechts-']);
            $this->draairichting = 'Rechts';
        } else {
            session(['imageLinksRechts' => 'links-']);
            $this->draairichting = 'Links';
        }

        session(['draairichting' =>  $this->draairichting]);
    }
    public function toggleDraairichting() {
        if($this->enkelDubbel) {
            $this->enkelDubbel = "Dubbele deuren";
            session(['imageDubbelEnkel' => 'dubbel-']);
            if($this->typeDeur != 'Draaideur') {
                $this->showDraairichting = false;
            } else {
                $this->showDraairichting = true;
            }
        } else {
            session(['imageDubbelEnkel' => 'enkel-']);
            $this->enkelDubbel = "Enkele deur";
            $this->showDraairichting = true;
        }
        session(['enkelDubbel' =>  $this->enkelDubbel]);
    }


    public function toggleGreepOption() {
        if($this->greepOption) {
            $this->hideGreep = false;
        } else {
            $this->hideGreep = true;
        }

        session(['greepOption' =>  $this->greepOption]);
    }

    public function setScharnier($val) {
        session(['scharnier' => $val]);
    }
    public function setDoorModel($value) {
        session(['modelDoor' => $value]);
    }

    public function setInmeten() {
        session(['inmeten' => $this->inmeten]);
    }

    public function removeSelectedColor($val) {
        $key = array_search($val, $this->color_choise);
        session()->pull('color_choise.'.$key);

    }

    public function setMonteren() {
        if($this->zelfMonteren) {

            session(['zelfMonteren' => false]);
        }
        session(['monteren' => $this->monteren]);
        if($this->monteren) {
            session(['inmeten' => true]);
            $this->showHideBezorgen = false;
        } else {
            $this->showHideBezorgen = true;
        }
    }

    public function setZelfMonteren() {
        if($this->monteren) {

            session(['monteren' => false]);
        }

        session(['zelfMonteren' => $this->zelfMonteren]);
    }

    public function setBezorgen() {
        if($this->afhalen) {
            session(['afhalen' => false]);
        }
        session(['bezorgen' => $this->bezorgen]);
    }

    public function setAfhalen() {

        if($this->bezorgen) {
            session(['bezorgen' => false]);
        }
        session(['afhalen' => $this->afhalen]);
    }
    public function setGreepLengte() {
        if($this->greep) {
            $this->greep = '55cm';
        } else {
            $this->greep = '35cm';
        }

        session(['greep' => $this->greep]);
    }

    public function setGreepType() {
        if($this->typeGreep) {
            $this->typeGreep = 'Klink';
        } else {
            $this->typeGreep = 'Greep';
        }
        session(['typeGreep' => $this->typeGreep]);
    }

    public function setGreepColor($var) {

        session(['greepColor' => $var]);
    }
    protected $rules = [
        'acceptConditions' => 'accepted',
        'acceptPayConditions' => 'accepted',
        'voornaam' => 'required',
        'achternaam' => 'required',
        'email' => 'required|email',
        'telefoon' => 'required',
        'straat' => 'required',
        'postcode' => 'required',
        'plaats' => 'required',
        'land' => 'required',
    ];
    public function storeForm($type) {

        $this->validate();

        $array = [
            'enkelDubbel' => $this->enkelDubbel,
            'typeDeur' => $this->typeDeur,
            'hoogte' => $this->hoogte,
            'breedte' => $this->breedte,
            'draairichting' => $this->draairichting,
            'modelDoor' => $this->modelDoor,
            'colorSampleOrDefColor' => $this->colorSampleOrDefColor,
            'color_choise' => $this->color_choise,
            'glas' => $this->glas,
            'greepOption' => $this->greepOption,
            'greep' => $this->greep,
            'inmeten' => $this->inmeten,
            'monteren' => $this->monteren,
            'bezorgen' => $this->bezorgen,
            'zelfMonteren' => $this->zelfMonteren,
            'afhalen' => $this->afhalen,
            'voornaam'=> $this->voornaam,
            'achternaam' => $this->achternaam,
            'email' => $this->email,
            'telefoon' => $this->telefoon,
            'straat' => $this->straat,
            'postcode' => $this->postcode,
            'plaats' => $this->plaats,
            'land' => $this->land,
            'type' => $type,
            'scharnier' => $this->scharnier,
            'typeGreep' => $this->typeGreep,
            'greepColor' => $this->greepColor,
        ];


        Mail::to($this->email)

            ->send(new PostMail($array));


        Mail::to('info@crewa.nl')
            ->send(new PostAdminMail($array));

            session()->forget(['typeDeur', 'hoogte', 'breedte', 'draairichting', 'modelDoor', 'colorSampleOrDefColor', 'color_choise',
                'glas', 'greepOption', 'greep', 'inmeten', 'monteren', 'zelfMonteren', 'afhalen', 'bezorgen', 'voornaam', 'achternaam', 'email', 'telefoon', 'straat','bericht',
                'postcode', 'plaats', 'land', 'scharnier', 'typeGreep', 'greepColor', 'acceptedConditions', 'acceptedPayConditions'
            ]);

        $this->acceptConditions = false;
        $this->acceptPayConditions = false;

        if($type == 'offerte') {
            $this->showSuccesOfferte = true;
            $this->showSuccesBestelling = false;
        } else if ($type == 'bestelling') {
            $this->showSuccesBestelling = true;
            $this->showSuccesOfferte = false;
        }


    }



    public function setContactDetails($name) {
        session([$name => $this->$name]);
    }

}
