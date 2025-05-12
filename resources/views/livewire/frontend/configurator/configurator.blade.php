
<div>
    <link rel="stylesheet" href="{{asset('/css/configurator.css')}}"/>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-8 configurator-column image-column">
            <div class="zoom-button-box">
                <button id="btn_ZoomIn" class="zoom-button"><i class='bx bx-zoom-in'></i></button>
                <button id="btn_ZoomOut" class="zoom-button"><i class='bx bx-zoom-out' ></i></button>
                <button id="btn_ZoomReset" class="zoom-button"><i class='bx bx-reset' ></i></button>
            </div>

            <div wire:loading.class="d-block" wire:target="toggleDraairichting, setTypeDoor, setDraairichting, setDoorModel, setDoorGlass"  class="display-none">
                <div class="spinner"></div>
            </div>

            <div class="configurator-image zoom" style="background-image:url({{asset('/storage/images/configurator/doors/deur-'.$this->imageTypeDeur.$this->imageDubbelEnkel.$this->imageLinksRechts.$this->imageGlas.'min.png')}}"></div>
            <div class="price-box">Uw prijs:<br/>
                € 250,- </div>

        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 configurator-column assembly-column">
            <form>
                <div class="accordion" id="doorConfigurator">
                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompose" aria-expanded="true" aria-controls="collapseOne">
                               <strong>1. Samenstellen</strong>
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseCompose" class="accordion-collapse collapse show" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div class="mb-3 row">
                                    <div class="col-12">
                                        <label for="number-of-doors" class="col-12 col-form-label">Enkele / dubbele deuren:</label>
                                        <input type="checkbox" class="switch aantal-switch" @if($this->enkelDubbel == 'Dubbele deuren') checked @endif wire:change="toggleDraairichting" wire:model="enkelDubbel" id="aantal-switch"/>
                                        <label class="switch-label aantal-switch-label" id="aantal-switch-label"  for="aantal-switch">
                                            <span id="align-left">Enkele deur</span>
                                            <span id="align-right">Dubbele deur</span>
                                        </label>

                                    </div>

                                </div>

                                <div wire:ignore class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="door-type-carousel" class="col-12 col-form-label">Type:</label>
                                        <section
                                            id="door-type-carousel"
                                            class="splide splide-door-gallery"
                                            aria-label="Gallerij met model deuren."
                                        >
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                    <li class="splide__slide type-door-list @if($this->typeDeur == 'Taatsdeur') active @endif" wire:click="setTypeDoor('Taatsdeur')" onclick="setTypeDoor(this)">
                                                        <img src="{{asset('/storage/images/configurator/doors/deur-taats-'.$this->imageDubbelEnkel.$this->imageLinksRechts.$this->imageGlas.'min.png')}}"/>
                                                        <div class="splide__title">Taatsdeur</div>
                                                    </li>
                                                    <li class="splide__slide type-door-list @if($this->typeDeur == 'Draaideur') active @endif" wire:click="setTypeDoor('Draaideur')" onclick="setTypeDoor(this)" >
                                                        <img  src="{{asset('/storage/images/configurator/doors/deur-taats-'.$this->imageDubbelEnkel.$this->imageLinksRechts.$this->imageGlas.'min.png')}}"/>
                                                        <div class="splide__title">Draaideur</div>
                                                    </li>
                                                    <li class="splide__slide type-door-list @if($this->typeDeur == 'Schuifdeur') active @endif" wire:click="setTypeDoor('Schuifdeur')" onclick="setTypeDoor(this)" >
                                                        <img  src="{{asset('/storage/images/configurator/doors/deur-taats-'.$this->imageDubbelEnkel.$this->imageLinksRechts.$this->imageGlas.'min.png')}}"/>
                                                        <div class="splide__title">Schuifdeur</div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </section>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <div class="input-group mb-3">
                                            <label for="number-of-doors" class="col-12 col-form-label">Hoogte:</label>
                                            <input type="number" class="form-control" wire:model="hoogte" wire:change="setHoogte()" aria-describedby="basic-addon2" value="{{$this->hoogte}}">
                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <div class="input-group mb-3">
                                            <label for="number-of-doors" class="col-12 col-form-label">Breedte:</label>
                                            <input type="number" class="form-control" wire:model="breedte" wire:change="setBreedte()" aria-describedby="basic-addon2" value="{{$this->breedte}}">
                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($this->showDraairichting)

                                    <div class="mb-3 row">
                                        <div class="col-12 form-cols">
                                            <label for="draairichting-switch" class="col-12 col-form-label">
                                                @if($this->enkelDubbel == 'Enkele deur')
                                                    Draairichting:
                                                @else
                                                    Actieve deur:
                                                    <a data-bs-toggle="modal" href="#tooltipModal2" >
                                                        <i class='bx bxs-help-circle tooltip-box'></i>
                                                    </a>
                                                @endif
                                            </label>

                                            <div class="modal" id="tooltipModal2" style="z-index:9999" data-bs-backdrop="static">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6>Actieve deur</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div><div class="container"></div>
                                                        <div class="tooltip-modal-body modal-body">
                                                            Maak de keuze welke deur uw actieve loopdeur wordt. <br/>
                                                            Op deze deur wordt indien gewenst de klink en slotkast geplaatst.<br/>
                                                            De andere deur kan worden vastgezet.<br/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="checkbox" class="switch draairichting-switch" @if($this->draairichting == 'Rechts') checked @endif wire:change="setDraairichting()" wire:model="draairichting" id="draairichting-switch"/>
                                            <label class="switch-label draairichting-switch-label" id="draairichting-switch-label" for="draairichting-switch">
                                                <span id="align-left">Links</span>
                                                <span id="align-right">Rechts</span>
                                            </label>

                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseDesign" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-configurator next-accordion btn-primary" >
                                           Volgende
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDesign" aria-expanded="false" aria-controls="collapseTwo">
                                2. Ontwerpen
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseDesign" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div wire:ignore class="mb-3 row">
                                    <div wire:ignore class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Model:</label>
                                        <section
                                            id="door-model-carousel"
                                            class="splide splide-glass-gallery"
                                            aria-label="Gallerij met model deuren."
                                        >
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model1') active @endif" wire:click.prevent="setDoorModel('model1')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model2') active @endif" wire:click.prevent="setDoorModel('model2')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model3') active @endif" wire:click.prevent="setDoorModel('model3')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model4') active @endif " wire:click.prevent="setDoorModel('model4')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model5') active @endif" wire:click.prevent="setDoorModel('model5')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img class="model-door-image @if($this->modelDoor == 'model6') active @endif" wire:click.prevent="setDoorModel('model6')" onclick="setDoorModel(this)" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                    </li>
                                                </ul>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Kleur:</label>

                                        <div class="color-box">
                                            <button type="button" class="btn btn-configurator open-color-box btn-primary" data-bs-toggle="modal" data-bs-target="#colorModal">
                                                <i class='bx bx-palette'></i>
                                            </button>
                                            <div class="color-button-box">
                                                <div class="selected-color-button-box2">
                                                    @if(count($this->color_choise))
                                                        @if($this->colorSampleOrDefColor == 'Definitief')
                                                            <p class="selected-color-title">Geselecteerde kleur</p>
                                                        @elseif($this->colorSampleOrDefColor == 'Sample')
                                                            <p class="selected-color-sample">Geselecteerde kleurstalen</p>

                                                        @endif
                                                    @else
                                                        <p class="selected-no-color-title">Geen kleur geselecteerd</p>
                                                    @endif
                                                    @foreach($this->color_choise as $color)

                                                        <button id="{{$color}}" disabled class="selected-color-box">{{$color}}
                                                            <i wire:click="removeSelectedColor('{{preg_replace('/\s+/', '',$color)}}')" class="bx bx-x color-box-trash"></i>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div wire:ignore.self class="modal fade" id="colorModal" tabindex="-1" style="z-index:1400;" data-keyboard="false" aria-labelledby="colorModalLabel" >
                                    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header color-modal-header">
                                                <div class="col-5 col-md-3 col-xl-2">
                                                    <h1 class="modal-title fs-4" id="colorModalLabel">
                                                        Kleuren

                                                        <a data-bs-toggle="modal" href="#tooltipModal" >
                                                            <i class='bx bxs-help-circle tooltip-box'></i>
                                                        </a>
                                                    </h1>

                                                </div>
                                                <div class="col-7 col-md-9 col-xl-10">
                                                    @if($showCollectionColors)
                                                        <a class="color-modal-back" wire:click="backToCollections()"><i class='bx bx-arrow-back'></i> Terug naar collectie's</a>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn-close btn-close-big-modal @if(count($this->color_choise) >1) hidden @endif" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div style="padding:0px;" class="col-5 col-md-3 col-xl-2">
                                                        <h6>Filteren</h6>
                                                        <br/>
                                                        @if(count($this->filters))
                                                            @foreach($this->filters as $filter)
                                                                <h6>{{$filter->title}}</h6>
                                                                <form>
                                                                <fieldset>
                                                                @foreach($filter->filterValues as $filterValue)

                                                                    <div class="filter-value-checkbox">
                                                                        <input class="filter-checkbox" wire:click="filterSelection({{$filterValue->id}})"  type="checkbox" id="{{$filterValue->id}}" wire:model="filter_value" value="{{$filterValue->id}}" />
                                                                        <label for="{{$filterValue->id}}"> {{$filterValue->title}}</label>
                                                                    </div>
                                                                @endforeach
                                                                </fieldset>
                                                                </form>
                                                            @endforeach
                                                            @if($this->filtersSelected)
                                                                <div wire:click="eraseFilters" class="erase-filter" disabled>Wis filters <i class="bx bx-x color-box-trash"></i></div>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <div class="col-7 col-md-9 col-xl-10">
                                                        <div class="col-12 selected-color-column">
                                                            @if(count($this->color_choise))
                                                                <h6>Geselecteerde kleuren</h6>
                                                                <div class="selected-color-button-box">
                                                                    @foreach($this->color_choise as $color)
                                                                        <button id="{{$color}}" disabled class="selected-color-box">{{$color}}
                                                                            <i wire:click="removeSelectedColor('{{preg_replace('/\s+/', '',$color)}}')" class="bx bx-x color-box-trash"></i>
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <br/>
                                                        @if($showCollections)
                                                            <div class="col-12">
                                                                <h3 class="modal-title">Collecties</h3>
                                                                <br/>
                                                                <div class="row">
                                                                    @foreach($this->categoryColors as $colors)
                                                                        @if($colors->getMedia('tumbnail')->first())
                                                                            <div wire:click="clickedCollection({{$colors->id}})" class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                                                                                <img class="configurator-colorcategory-tumnail" src="{{$colors->getMedia('tumbnail')->first()->getUrl('tumbnails')}}"/>
                                                                                <div class="configurator-colorcategory-tumnail-title">{{$colors->title}}</div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-12 @if(!$showCollectionColors) hidden @endif">
                                                            <h3 class="modal-title">Kleuren van de collectie {{$collectionTitle}}</h3>
                                                            <br/>
                                                            <div  class="row">
                                                                @if(count($this->colors))
                                                                    @foreach($this->colors as $color)
                                                                        @if($color->getMedia('color_images')->first())
                                                                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 color-image">
                                                                                <div wire:click="setColor('{{preg_replace('/\s+/', '', $color->title)}}')" class="configurator-color-category-tumnbail @if(in_array(preg_replace('/\s+/', '', $color->title), $this->color_choise)) active @endif" id="{{preg_replace('/\s+/', '', $color->title)}}" style="background-image:url({{$color->getMedia('color_images')->first()->getUrl('tumbnails')}})">
                                                                                    <div class="lookup-image">
                                                                                        <a data-size="fullscreen" href="{{$color->getMedia('color_images')->first()->getUrl('tumbnails')}}" data-toggle="lightbox" class="my-lightbox-toggle">
                                                                                            <i class='bx bx-zoom-in'></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="configurator-colorcategory-tumnail-title">{{$color->title}}</div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                    @else
                                                                        <h6>Geen kleuren in deze collectie gevonden</h6>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-12 @if(!$showColorFilter) hidden @endif">
                                                                <h3 class="modal-title">{{$this->filter_title}}</h3>
                                                                <br/>
                                                                <div  class="row">
                                                                    @foreach($this->colors as $color)
                                                                        @if($color->getMedia('color_images')->first())
                                                                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 color-image">
                                                                                <div wire:click="setColor('{{preg_replace('/\s+/', '', $color->title)}}')" class="configurator-color-category-tumnbail @if(in_array(preg_replace('/\s+/', '', $color->title), $this->color_choise)) active @endif" id="{{preg_replace('/\s+/', '', $color->title)}}" style="background-image:url({{$color->getMedia('color_images')->first()->getUrl('tumbnails')}})">
                                                                                    <div class="lookup-image">
                                                                                        <i class='bx bx-zoom-in'></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="configurator-colorcategory-tumnail-title">{{$color->title}}</div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-bs-dismiss="modal" wire:click="setColorSampleOrDefColor('Definitief')" class="btn btn-add-color btn-primary" @if(count($this->color_choise) >1) disabled @endif>Kleur toevoegen</button>
                                                    <button type="button" data-bs-dismiss="modal" wire:click="setColorSampleOrDefColor('Sample')" class="btn btn-add-color-sample btn-primary" @if(count($this->color_choise) < 1 || count($this->color_choise) > 3)) disabled @endif>Kleurstalen aanvragen</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{--tooltip modal--}}
                                    <div class="modal" id="tooltipModal" style="z-index:9999" data-bs-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6>Kleuren selecteren</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div><div class="container"></div>
                                                <div class="tooltip-modal-body modal-body">
                                                    Nog niet helemaal zeker van de juiste kleur?<br/>
                                                    U kunt één of meerdere (maximaal 3) kleuren selecteren om deze aan te vragen als kleurstaal.<br/><br/>
                                                    Weet u al welke kleur u wilt? Selecteer dan één kleur en klik op 'kleur toevoegen'
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div wire:ignore class="mb-3 row">
                                    <div wire:ignore class="col-12 form-cols">
                                        <label for="door-glass-carousel" class="col-12 col-form-label">Glas:</label>
                                        <section
                                            id="door-glass-carousel"
                                            class="splide splide-door-gallery"
                                            aria-label="Gallerij met model deuren."
                                        >
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                    <li class="splide__slide glass-door-list @if($this->glas == 'Transparant') active @endif" wire:click.prevent="setDoorGlass('Transparant')" onclick="setDoorGlass(this)">
                                                        <img class="glass-door-image"  src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-helder-min.png')}}" alt="">
                                                        <div class="splide__title">Transparant</div>
                                                    </li>
                                                    <li class="splide__slide glass-door-list @if($this->glas == 'Grijs') active @endif" wire:click.prevent="setDoorGlass('Grijs')" onclick="setDoorGlass(this)" >
                                                        <img class="glass-door-image" src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-grijs-min.png')}}" alt="">
                                                        <div class="splide__title">Grijs</div>
                                                    </li>
                                                    <li class="splide__slide glass-door-list @if($this->glas == 'Brons') active @endif" wire:click.prevent="setDoorGlass('Brons')" onclick="setDoorGlass(this)">
                                                        <img class="glass-door-image"  src="{{asset('/storage/images/configurator/doors/deur-taats-dubbel-links-brons-min.png')}}" alt="">
                                                        <div class="splide__title">Brons</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseHandles" aria-expanded="false" aria-controls="collapseThree" class="btn btn-configurator next-accordion btn-primary" >
                                            Volgende
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHandles" aria-expanded="false" aria-controls="collapseThree">
                                3. Deurgrepen
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseHandles" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="greep-option-switch" class="col-12 col-form-label">
                                            Greep:
                                            <a data-bs-toggle="modal" href="#tooltipModal3" >
                                                <i class='bx bxs-help-circle tooltip-box'></i>
                                            </a>
                                        </label>


                                        <div class="modal" id="tooltipModal3" style="z-index:9999" data-bs-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6>Deurgrepen</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div><div class="container"></div>
                                                    <div class="tooltip-modal-body modal-body">
                                                        Als u kiest voor een greep, worden de slotkast en het sluitpaneel standaard ingevreest en meegeleverd.<br/><br/>
                                                        Als u kiest voor <strong>geen</strong> greep, worden de slotkast en sluitpaneel <strong>niet</strong> ingevreest en <strong>niet </strong>meegeleverd.<br/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="checkbox" class="switch greep-option-switch" @if($this->greepOption) checked @endif wire:change="toggleGreepOption" wire:model="greepOption" id="greep-option-switch"/>
                                        <label class="switch-label greep-option-switch-label" id="greep-option-switch-label"  for="greep-option-switch">
                                            <span id="align-left">Nee</span>
                                            <span id="align-right">Ja</span>
                                        </label>
                                    </div>
                                </div>
                                @if($this->greepOption)
                                    @if($this->typeDeur == 'Draaideur')

                                        <div class="mb-3 row">
                                            <div class="col-12 form-cols">
                                                <label for="number-of-doors" class="col-12 col-form-label">Type greep:</label>
                                                <input type="checkbox" class="switch type-greep-switch" @if($this->typeGreep == 'Klink') checked @endif wire:change="setGreepType()" wire:model="typeGreep" id="type-greep-switch"/>
                                                <label class="switch-label type-greep-switch-label" id="type-greep-switch-label"  for="type-greep-switch">
                                                    <span id="align-left">Greep</span>
                                                    <span id="align-right">Klink</span>
                                                </label>
                                            </div>
                                        </div>

                                    @endif

                                    @if($this->typeGreep == 'Greep' || $this->typeDeur != 'Draaideur')
                                        <div wire:ignore.self class="mb-3 row">
                                            <div wire:ignore.self class="col-12 form-cols">
                                                <label for="door-glass-carousel" class="col-12 col-form-label">Deurgreep:</label>
                                                <img class="door-klink-image active" src="{{asset('/storage/images/configurator/klink.jpg')}}"/>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-12 form-cols">
                                                <label for="number-of-doors" class="col-12 col-form-label">Greep lengte:</label>
                                                <input type="checkbox" class="switch greep-switch" @if($this->greep == '55cm') checked @endif wire:change="setGreepLengte()" wire:model="greep" id="greep-switch"/>
                                                <label class="switch-label greep-switch-label" id="greep-switch-label"  for="greep-switch">
                                                    <span id="align-left">35cm</span>
                                                    <span id="align-right">55cm</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    @if($this->typeGreep == 'Klink' && $this->typeDeur == 'Draaideur')
                                        <div wire:ignore.self class="mb-3 row">
                                            <div wire:ignore.self class="col-12 form-cols">
                                                <label for="door-glass-carousel" class="col-12 col-form-label">Deurklink:</label>
                                                <img class="door-klink-image active" src="{{asset('/storage/images/configurator/klink.jpg')}}"/>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-12 form-cols">
                                                <label for="number-of-doors" class="col-12 col-form-label">Kleur beslag:</label>
                                                <ul class="color-greep-list">
                                                    <li wire:click="setGreepColor('Rvs')" class="color-greep"><div class="border-box @if($this->greepColor == 'Rvs') active @endif"><div class="color-item" id="color-rvs"></div></div>RVS</li>
                                                    <li wire:click="setGreepColor('Brons')" class="color-greep"><div class="border-box @if($this->greepColor == 'Brons') active @endif"><div id="color-brons" class="color-item"></div></div>Brons</li>
                                                    <li wire:click="setGreepColor('Zwart')" class="color-greep"><div class="border-box @if($this->greepColor == 'Zwart') active @endif"><div id="color-black" class="color-item"></div></div>Zwart</li>

                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    @if($this->typeDeur == 'Draaideur')
                                        <div class="mb-3 row">
                                            <div class="col-12 form-cols">
                                                <label for="number-of-doors" class="col-12 col-form-label">Scharnier:</label>
                                                <label class="montage-options">Scharnieren zichtbaar
                                                    <input type="radio" @if($this->scharnier == 'Zichtbaar') checked @endif wire:change="setScharnier('Zichtbaar')" id="zichtbaar" name="scharnier">
                                                    <span class="checkmark"></span>
                                                </label>

                                                <label class="montage-options">Scharnieren onzichtbaar
                                                    <input type="radio" @if($this->scharnier == 'Onzichtbaar') checked @endif wire:change="setScharnier('Onzichtbaar')" id="onzichtbaar" name="scharnier">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif


                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseAssembly" aria-expanded="false" aria-controls="collapseFour" class="btn btn-configurator next-accordion btn-primary" >
                                            Volgende
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAssembly" aria-expanded="false" aria-controls="collapseFour">
                                4. Opties
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseAssembly" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Opties:</label>
                                        <label class="montage-options">Laten inmeten (in NL, excl. waddeneilanden)
                                            <a data-bs-toggle="modal" href="#tooltipModal4" >
                                                <i class='bx bxs-help-circle tooltip-box'></i>
                                            </a>
                                            <input type="checkbox" checked="checked" wire:change="setInmeten()" wire:model="inmeten">
                                            <span class="checkmark"></span>
                                        </label>

                                        <div class="modal" id="tooltipModal4" style="z-index:9999" data-bs-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6>Inmeten</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div><div class="container"></div>
                                                    <div class="tooltip-modal-body modal-body">
                                                        Als u er voor kiest om de deur zelf in te meten is dat op eigen risico. <br/>
                                                        Bestelde deuren kunnen niet geretourneerd worden.<br/>
                                                        <br/>
                                                        Indien u kiest voor de optie "laten monteren" wordt de optie "laten inmeten" automatisch aangevinkt<br/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="montage-options">Laten monteren (in NL, excl. waddeneilanden)
                                            <input type="checkbox" wire:change="setMonteren()" wire:model="monteren">
                                            <span class="checkmark"></span>
                                        </label>

                                        <label class="montage-options">Zelf monteren
                                            <input type="checkbox" wire:change="setZelfMonteren()" wire:model="zelfMonteren">
                                            <span class="checkmark"></span>
                                        </label>
                                        @if($this->showHideBezorgen)
                                            <label class="montage-options">Laten bezorgen (in NL, excl. waddeneilanden)
                                                <input type="checkbox" wire:change="setBezorgen()" wire:model="bezorgen">
                                                <span class="checkmark"></span>
                                            </label>

                                            <label class="montage-options">Afhalen
                                                <input type="checkbox" wire:change="setAfhalen()" wire:model="afhalen">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersonalData" aria-expanded="false" aria-controls="collapseFive" class="btn btn-configurator next-accordion btn-primary" >
                                            Volgende
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersonalData" aria-expanded="false" aria-controls="collapseFive">
                                5. Uw gegevens
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapsePersonalData" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Uw persoonlijke informatie:</label>
                                        <div class="row row-no-padding">
                                            <div class="form-floating col-12 col-xl-6 ">
                                                <input wire:change="setContactDetails('voornaam')" value="{{$this->voornaam}}" wire:model="voornaam" type="text" class="form-control" id="floatingFirstName" placeholder="Voornaam *">
                                                <label for="floatingFirstName">Voornaam *</label>
                                                @error('voornaam')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-12 col-xl-6">
                                                <input wire:change="setContactDetails('achternaam')" wire:model="achternaam" type="text" class="form-control" id="floatingLastName" placeholder="Achternaam *">
                                                <label for="floatingLastName">Achternaam *</label>
                                                @error('achternaam')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            <div class="form-floating col-12">
                                                <input wire:change="setContactDetails('email')" wire:model="email" type="email" class="form-control" id="floatingEmail" placeholder="E-Mailadres *">
                                                <label for="floatingEmail">E-Mailadres *</label>
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-floating col-12">
                                                <input wire:change="setContactDetails('telefoon')" wire:model="telefoon" type="tel" class="form-control" id="floatingNumber" placeholder="Telefoonnummer *">
                                                <label for="floatingNumber">Telefoonnummer *</label>
                                                @error('telefoon')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Uw adres:</label>
                                        <div class="row row-no-padding">
                                            <div class="form-floating col-12">
                                                <input wire:change="setContactDetails('straat')" wire:model="straat" type="text" class="form-control" id="floatingAdres" placeholder="Straat + huisnummer *">
                                                <label for="floatingAdres">Straat + huisnummer *</label>
                                                @error('straat')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-12">
                                                <input wire:change="setContactDetails('postcode')" wire:model="postcode" type="text" class="form-control" id="floatingZipcode" placeholder="Postcode *">
                                                <label for="floatingZipcode">Postcode *</label>
                                                @error('postcode')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-floating col-12">
                                                <input wire:change="setContactDetails('plaats')" wire:model="plaats" type="text" class="form-control" id="floatingPlace" placeholder="Plaats *">
                                                <label for="floatingPlace">Plaats *</label>
                                                @error('plaats')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-12 form-stable">
                                                <label for="floatingCountry">Land *</label>
                                                <select wire:change="setContactDetails('land')" wire:model="land" class="form-control">
                                                    <option value="Nederland">Nederland</option>
                                                    <option value="Belgie">Belgie</option>
                                                    <option value="Duitsland">Duitsland</option>
                                                    <option value="Luxemburg">Luxemburg</option>
                                                </select>
                                                @error('land')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Uw bericht:</label>
                                        <textarea class="form-control" wire:change="setContactDetails('bericht')" wire:model="bericht" placeholder="bericht"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseOverview" aria-expanded="false" aria-controls="collapseSix" class="btn btn-configurator next-accordion btn-primary" >
                                            Volgende
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOverview" aria-expanded="false" aria-controls="collapseSix">
                               6. Overzicht
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseOverview" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <div class="mb-3 row">
                                    <div class="col-12 form-cols">
                                        <label for="number-of-doors" class="col-12 col-form-label">Uw samengestelde deur:</label>
                                            <div class="row">
                                                <label class="col-12 overview-label">1. Samenstellen:</label>
                                                <div class="col-12 overview-box">
                                                    <div class="row">
                                                        <label class="col-6 strong-label">Enkel/ dubbele deur:</label>
                                                        <div class="col-6">
                                                            {{$this->enkelDubbel}}
                                                        </div>
                                                        <label class="col-6 strong-label">Type deur:</label>
                                                        <div class="col-6 ">
                                                            {{$this->typeDeur}}
                                                        </div>
                                                        <label class="col-6 strong-label">Hoogte:</label>
                                                        <div class="col-6 ">
                                                            {{$this->hoogte}}cm
                                                        </div>
                                                        <label class="col-6  strong-label">Breedte:</label>
                                                        <div class="col-6 ">
                                                            {{$this->breedte}}cm
                                                        </div>
                                                        @if ($this->showDraairichting)
                                                            @if($this->enkelDubbel == "Enkele deur")
                                                                <label class="col-6  strong-label">Draairichting:</label>
                                                            @else
                                                                <label class="col-6  strong-label">Actieve deur:</label>
                                                            @endif
                                                            <div class="col-6">
                                                                {{$this->draairichting}}
                                                            </div
                                                        @endif
                                                    </div>
                                                </div>

                                                <label class="col-12 overview-label">2. Ontwerpen:</label>
                                                <div class="col-12 overview-box">
                                                    <div class="row">
                                                        <label class="col-6 strong-label">Model:</label>
                                                        <div class="col-6 ">
                                                            {{$this->modelDoor}}
                                                        </div>


                                                        <label class="col-6  strong-label">Kleur:</label>
                                                        <div class="col-6 ">
                                                            @if(count($this->color_choise))
                                                                @if($this->colorSampleOrDefColor == 'Sample')
                                                                    Kleurstalen aanvragen:
                                                                @else
                                                                    Gekozen kleur:
                                                                @endif
                                                                @foreach($this->color_choise as $color)
                                                                    <div class="selected-colors">{{$color}}</div>
                                                                @endforeach
                                                            @else
                                                                Geen kleur geselecteerd
                                                            @endif
                                                        </div>


                                                        <label class="col-6  strong-label">Glas:</label>
                                                        <div class="col-6 ">
                                                            {{$this->glas}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="col-12 overview-label">3. Deurgrepen:</label>
                                                <div class="col-12 overview-box">
                                                    <div class="row">
                                                        <label class="col-6  strong-label">Deurgreep:</label>
                                                        <div class="col-6 ">
                                                            @if($this->greepOption)
                                                                Ja
                                                            @else
                                                                Nee
                                                            @endif
                                                        </div>

                                                        @if($this->greepOption)
                                                            <label class="col-6 strong-label">Type greep:</label>
                                                            <div class="col-6 ">
                                                                {{$this->typeGreep}}
                                                            </div>
                                                        @endif

                                                        @if($this->typeGreep == 'Greep' && $this->greepOption)
                                                            <label class="col-6 strong-label">Lengte deurgreep:</label>
                                                            <div class="col-6 ">
                                                                {{$this->greep}}
                                                            </div>
                                                        @endif

                                                        @if($this->typeDeur == 'Draaideur')
                                                            @if($this->typeGreep == 'Klink')
                                                                <label class="col-6 strong-label">Kleur beslag:</label>
                                                                <div class="col-6 ">
                                                                    {{$this->greepColor}}
                                                                </div>
                                                            @endif

                                                            <label class="col-6 strong-label">Scharnier:</label>
                                                            <div class="col-6 ">
                                                                {{$this->scharnier}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <label class="col-12 overview-label">4. Montage:</label>
                                                <div class="col-12 overview-box">
                                                    <div class="row">
                                                        @if($this->inmeten)
                                                            <label class="col-6  strong-label">Inmeten:</label>
                                                            <div class="col-6 ">
                                                                Ja
                                                            </div>
                                                        @endif

                                                        @if($this->monteren)
                                                            <label class="col-6  strong-label">Monteren:</label>
                                                            <div class="col-6 ">
                                                                Ja
                                                            </div>
                                                        @endif
                                                        @if($this->zelfMonteren)
                                                            <label class="col-6  strong-label">Zelf monteren:</label>
                                                            <div class="col-6 ">
                                                                Ja
                                                            </div>
                                                        @endif
                                                        @if($this->bezorgen)
                                                            <label class="col-6  strong-label">Bezorgen:</label>
                                                            <div class="col-6 ">
                                                                Ja
                                                            </div>
                                                        @endif

                                                            @if($this->afhalen)
                                                                <label class="col-6  strong-label">Afhalen:</label>
                                                                <div class="col-6 ">
                                                                    Ja
                                                                </div>
                                                            @endif


                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseAfronden" aria-expanded="false" aria-controls="collapseSeven" class="btn btn-configurator next-accordion btn-primary" >
                                            Volgende
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item configurator-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button configurator-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAfronden" aria-expanded="false" aria-controls="collapseSeven">
                                7. Afronden
                            </button>
                        </h2>
                        <div wire:ignore.self id="collapseAfronden" class="accordion-collapse collapse" data-bs-parent="#doorConfigurator">
                            <div class="accordion-body">
                                <label for="number-of-doors" class="col-12 col-form-label">Betalingsvoorwaarden:</label>
                                <div class="row">
                                 - U kunt de betaling vooraf levering voldoen<br/>
                                    - Betaling bij levering<br/>
                                </div>
                                <br/><br/>
                                <div class="mb-3 row">
                                    <div class="col-12">
                                        <label class="montage-options">Ik ga akkoord met de <a href="/voorwaarden">algemene voorwaarden</a>
                                            <input type="checkbox" wire:model="acceptConditions">
                                            <span class="checkmark"></span>
                                        </label>

                                        <label class="montage-options">Ik ga akkoord met de betaal voorwaarden
                                            <input type="checkbox" wire:model="acceptPayConditions">
                                            <span class="checkmark"></span>
                                        </label>

                                        @error('acceptConditions')
                                       <span class="text-danger">- U dient de <a href="/voorwaarden" target="_blank">voorwaarden</a> te accepteren</span><br/>
                                        @enderror

                                        @error('acceptPayConditions')
                                        <span class="text-danger">- U dient de bovenstaande betaal voorwaarden te accepteren</span><br/>
                                        @enderror

                                        @if(count($errors))
                                            @if($errors->has('voornaam') || $errors->has('achternaam') || $errors->has('email') || $errors->has('telefoon') || $errors->has('postcode') || $errors->has('straat') || $errors->has('plaats') || $errors->has('land'))
                                                <span class="text-danger">- Uw <a class="accordion-dummy-button" data-bs-toggle="collapse" data-bs-target="#collapsePersonalData" aria-expanded="false" aria-controls="collapseFive">gegevens</a> zijn niet volledig ingevuld</span><br/>
                                            @else

                                            @endif
                                        @endif



                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="button-next-accordion-box col-12 form-cols">
                                        <div class="finish-buttons">
                                            <button type="button" wire:click.prevent="storeForm('offerte')" class="btn btn-configurator left-finish-accordion btn-primary" >
                                                <i  wire:loading.class="d-inline-block" wire:target="storeForm" class="display-none fa fa-spinner fa-spin"></i> Offerte aanvragen


                                            </button>
                                            @if($this->land == 'Nederland')
                                                <button type="button" wire:click.prevent="storeForm('bestelling')" class="btn btn-configurator right-finish-accordion btn-primary" >
                                                    <i  wire:loading.class="d-inline-block" wire:target="storeForm" class="display-none fa fa-spinner fa-spin"></i>Bestelling plaatsen

                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">

                                    @if($this->showSuccesOfferte)
                                        <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                            De offerte wordt zo snel mogelijk naar u toegestuurd. U heeft een e-mail ontvangen met de samenvatting van uw aanvraag.
                                            <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if($this->showSuccesBestelling)
                                        <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                            De bestelling is geplaatst. U heeft een e-mail ontvangen met de samenvatting van uw bestelling.
                                            <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

<script>

    Livewire.hook('morph.added',  ({ el }) => {
        document.querySelectorAll('.my-lightbox-toggle').forEach(el => el.addEventListener('click', Lightbox.initialize));
    });



    document.addEventListener( 'DOMContentLoaded', function() {



        const splide2 = new Splide('#door-glass-carousel', {
            start: 0,
            perPage: 3,
            pagination: false,
            drag: false,
            breakpoints: {
                1300: {
                    perPage: 2,
                    drag: true,
                }
            }

        });

        splide2.mount();

        const splide = new Splide( '#door-model-carousel', {
            start  : 0,
            perPage: 3,
            pagination:false,
            breakpoints: {
                1300: {
                    perPage:2,
                }
            }
        } );

        splide.mount();

        const splide3 = new Splide('#door-type-carousel', {
            start: 0,
            perPage: 3,
            pagination: false,
            drag: false,
            breakpoints: {
                1300: {
                    perPage: 2,
                    drag: true,
                }
            }

        });
        splide3.mount();
    });



    document.addEventListener('updateFilter', () => {
        jQuery(".filter-checkbox").prop('checked', false);
        jQuery(".filter-checkbox").removeAttr('checked');
    });

    function setTypeDoor(e) {
        jQuery('.type-door-list').removeClass('active');
        jQuery(e).addClass('active');
    }

    function setGreepColor(e) {
        jQuery('.border-box').removeClass('active');
        jQuery(e).find('div').addClass('active');
    }

    function setDoorModel(e) {
        jQuery('img.model-door-image').removeClass('active');
       jQuery(e).addClass('active');
    }

    function setDoorGlass(e) {
        jQuery('.glass-door-list').removeClass('active');
        jQuery(e).addClass('active');
    }


    let currentZoom = 1.0;

    jQuery(document).ready(function () {
        jQuery('#btn_ZoomIn').click(
            function () {
                currentZoom = currentZoom+0.04;
                const scaleString = "scale("+currentZoom+")";
                jQuery('.configurator-image').css("transform", scaleString);
            })
        jQuery('#btn_ZoomOut').click(
            function () {
                if(currentZoom >1) {

                    currentZoom = currentZoom - 0.04;
                    const scaleString = "scale(" + currentZoom + ")";
                    jQuery('.configurator-image').css("transform", scaleString);
                }
            });

        jQuery('#btn_ZoomReset').click(function() {

            const scaleString = "scale(1)";
            currentZoom = 1.0;
            jQuery('.configurator-image').css("transform", scaleString);
        });

    });

    const myModal = new bootstrap.Modal('#colorModal', {
        keyboard: false
    });


</script>
