
<div>
    <div class="page">
        @auth
            <div class="row add-block-row">
                <div class="add-block-box col-12">
                    <div class="add-block-box-header">
                        <div class="dashboard">
                            <a href="/auth/dashboard">Dashboard</a>
                        </div>
                        <div class="save-block-box">
                            <button class="btn btn-secondary" onclick="saveBlocksToDatabase(this)"><i class='bx bx-save'></i></button>
                        </div>

                        <i class='bx bx-plus add-block' onclick="showColumns()"></i>
                    </div>
                    <div class="add-block-box column-choise">
                        <div class="modal fade" id="add-column-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addColumn">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add-column-modal">Kies een indeling</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div id="column-1" class="col-6 column-choises" onclick="addColumn(this)">
                                                <div class="one-column"></div>
                                            </div>
                                            <div id="column-2" class="col-6 column-choises" onclick="addColumn(this)">
                                                <div class="two-column"></div>
                                                <div class="two-column"></div>
                                            </div>
                                            <div id="column-3" class="col-6 column-choises" onclick="addColumn(this)">
                                                <div class="three-column"></div>
                                                <div class="three-column"></div>
                                                <div class="three-column"></div>

                                            </div>
                                            <div id="column-4"class="col-6 column-choises" onclick="addColumn(this)">
                                                <div class="four-column"></div>
                                                <div class="four-column"></div>
                                                <div class="four-column"></div>
                                                <div class="four-column"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="add-block-modal block-item-choise ">
                        <div class="modal fade" id="add-block-item-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBlockItem" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addBlockItem">Voeg een blok toe</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="text-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="text-block-item"/>
                                                    <i class='bx bx-text'></i><br/>
                                                    Tekst blok
                                                </label>
                                            </div>
                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="image-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="afbeelding-block-item"/>
                                                    <i class='bx bx-image'></i><br/>
                                                    Afbeelding blok
                                                </label>
                                            </div>

                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="slider-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="slider"/>
                                                    <i class='bx bx-slideshow'></i><br/>
                                                    Slider blok
                                                </label>
                                            </div>

                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="impression-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="impression"/>
                                                    <i class='bx bx-images'></i><br/>
                                                    Impressie blok
                                                </label>
                                            </div>

                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="review-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="review"/>
                                                    <i class='bx bx-message-dots'></i><br/>
                                                    Review blok
                                                </label>
                                            </div>

                                            <div class="col-6 block-item-type" onclick="setBlockItemType(this)" id="contact-block-item">
                                                <label class="block-item-type-label">
                                                    <input type="radio" name="blockItemType" value="contact"/>
                                                    <i class='bx bxs-contact' ></i><br/>
                                                    Contact blok
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="error-message select-block-item hidden">
                                        Selecteer een blok
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addBlockItemType()">Toevoegen</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-column-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editColumn" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content edit-column-modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addBlockItem">Column bewerken</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Achtergrond
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Achtergrondkleur bewerken</label>
                                                                    <br/><Br/>
                                                                    Template kleuren:<br/> #fff (Zwart)<br/>#4d3631 (Bruin)<br/>#222222 (Donkergrijs) <br/> #333 (Lichtgrijs) <br/><br/>
                                                                    <input type="color" class="form-control form-control-color" id="edit-column-color" title="Kies een kleur">
                                                                    <br/>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Margins
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin top</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-column-margin-top" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin bottom</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-column-margin-bottom" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin links</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-column-margin-left" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin rechts</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-column-margin-right" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Paddings
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Paddding</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="edit-column-padding" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                Aangepaste CSS
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                Word aan gewerkt.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item slider-accordion-item hidden">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                Slider
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Slider tekst</label>
                                                                    <div class="input-group">
                                                                        <textarea id="edit-slider-text" type="number" class="form-control" aria-label="padding pixels"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                                        <button type="button" class="btn btn-primary" onclick="saveEditedColumn(this)">opslaan</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="edit-parent-column-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editParentColumn" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content edit-column-modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editParentColumn">Hoofd column bewerken</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Achtergrond
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Achtergrondkleur bewerken</label><br/>
                                                                    <br/>
                                                                    Template kleuren:<br/> #fff (Zwart)<br/>#4d3631 (Bruin)<br/>#222222 (Donkergrijs) <br/> #333 (Lichtgrijs) <br/><br/>

                                                                    <input type="color" class="form-control form-control-color" id="edit-parent-column-color" value="#FFF" title="Kies een kleur">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Margins
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin top</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-parent-column-margin-top" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin bottom</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-parent-column-margin-bottom" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin links</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-parent-column-margin-left" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Margin rechts</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" value="0" id="edit-parent-column-margin-right" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Paddings
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">Paddding</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="edit-parent-column-padding" aria-label="padding pixels">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">px</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                Aangepaste CSS
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                Word aan gewerkt.
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                Afmetingen
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">max breedte</label>
                                                                    <div class="input-group">
                                                                        <input type="text" value="100%" class="form-control" id="edit-parent-column-breedte" aria-label="padding pixels">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="edit-column-color" class="form-label">max inner breedte (standaard 1320px)</label>
                                                                    <div class="input-group">
                                                                        <input type="text" value="1320px" class="form-control" id="edit-parent-column-inner-breedte" aria-label="padding pixels">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                                        <button type="button" class="btn btn-primary" onclick="saveEditedParentColumn(this)">opslaan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="impression-placeholder" class="hidden"></div>
            <div id="review-placeholder" class="hidden"></div>
            <div id="contact-placeholder" class="hidden"></div>
        @endauth
{{--        @include('livewire.frontend.components.points')--}}
        @include('livewire.frontend.components.menu')

        <div class="home-row block-row" wire:sortable="updateOrder" wire:ignore>
            @php $i = 0; @endphp

            @foreach(\App\Models\PageBlock::orderBy('order_id', 'asc')->get() as $pageblocks)
                @if($pageblocks->page_id == $this->pageid)
                    {!! $pageblocks->value !!}
                    @php $i++; @endphp

{{--                    @if($i == 1)--}}
{{--                        @if($this->pageid == "16")--}}
{{--                            <div class="full-width-box" style="background-color:black">--}}
{{--                                <div class="container" style="background-color:black">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <script type="text/javascript" src="https://beheerapp.onlineafspraken.nl/build/widget/widget.js" data-api-key="alah21oooa98-alaz00" data-widget-id="920493fe-31a9-47fe-bdc8-1cbb55b8ba02" data-mode="triggerButtonRight" defer></script>--}}
{{--                                        <div id="_oa_widget_root"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endif--}}
                @endif
            @endforeach


            @if(!$this->pageid)
                @foreach(\App\Models\PageBlock::where('page_id', $this->indexPage->id)->orderBy('order_id', 'asc')->get() as $pageblocks)
                        {!! $pageblocks->value !!}
                @endforeach
            @endif
        </div>
            @if($this->page->route !== 'offerte-aanvragen')
                @include('livewire.frontend.components.footer')
                @else
                @include('livewire.frontend.configurator.configurator')
            @endif
    </div>
</div>
<script type="text/javascript">

    //load blocks

    var addButton = function (context) {
        var ui = $.summernote.ui;

        // create button
        var button = ui.button({
            contents: '<i class="fa-solid fa-square-plus" />',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.

                context.invoke('editor.pasteHTML', '<button class="btn btn-secondary editor-buttons">Button</button>');                }
        });

        return button.render(); // return button as jquery object
    }

    var addFacebook = function (context) {
        var ui = $.summernote.ui;

        // create button
        var faceBook = ui.button({
            contents: '<i class="fa-brands fa-facebook-f" style="color:#F7F5F3"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->facebook}}"><img src="{{asset('/public/storage/images/frontend/uploads/facebook.svg')}}" class="facebook-icon" alt="facebook"/></a>');

            }
        });

        return faceBook.render(); // return button as jquery object
    }

    var addInsta = function (context) {
        var ui = $.summernote.ui;

        // create button
        var insta = ui.button({
            contents: '<i class="fa-brands fa-instagram" style="color:#F7F5F3"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->instagram}}"><img src="{{asset('/public/storage/images/frontend/uploads/instagram.svg')}}" class="facebook-icon" alt="instagram"/></a>');

            }
        });

        return insta.render(); // return button as jquery object
    }

    var addLinkedIn = function (context) {
        var ui = $.summernote.ui;

        // create button
        var linkedin = ui.button({
            contents: '<i class="fa-brands fa-linkedin-in" style="color:#F7F5F3"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->linkedin}}"><img src="{{asset('/public/storage/images/frontend/uploads/linkedin.svg')}}" class="facebook-icon" alt="linkedin"/></a>');

            }
        });

        return linkedin.render(); // return button as jquery object
    }


    var addFacebookDark = function (context) {
        var ui = $.summernote.ui;

        // create button
        var faceBook = ui.button({
            contents: '<i class="fa-brands fa-facebook-f" style="color:#1d140c"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->facebook}}"><img src="{{asset('/public/storage/images/frontend/uploads/facebookDark.svg')}}" class="facebook-icon" alt="facebook"/></a>');

            }
        });

        return faceBook.render(); // return button as jquery object
    }

    var addInstaDark = function (context) {
        var ui = $.summernote.ui;

        // create button
        var insta = ui.button({
            contents: '<i class="fa-brands fa-instagram" style="color:#1d140c"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->instagram}}"><img src="{{asset('/public/storage/images/frontend/uploads/instagramDark.svg')}}" class="facebook-icon" alt="instagram"/></a>');

            }
        });

        return insta.render(); // return button as jquery object
    }

    var addLinkedInDark = function (context) {
        var ui = $.summernote.ui;

        // create button
        var linkedin = ui.button({
            contents: '<i class="fa-brands fa-linkedin-in" style="color:#1d140c"></i>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<a href="{{$this->settings->linkedin}}"><img src="{{asset('/storage/images/frontend/uploads/linkedinDark.svg')}}" class="facebook-icon" alt="linkedin"/></a>');

            }
        });

        return linkedin.render(); // return button as jquery object
    }

    let blockImpressions = jQuery('.block-impressions');
    jQuery.each(blockImpressions, function (key, value) {
        jQuery('#'+value.id).load('impressions');
    });

    let blockReviews = jQuery('.block-reviews');
    jQuery.each(blockReviews, function (key, value) {
        jQuery('#'+value.id).load('reviews');
    });

    let contactForms = jQuery('.block-contact-form');
    jQuery.each(contactForms, function (key, value) {
        jQuery('#'+value.id).load('contactForm');
    });


    jQuery('#edit-slider-text').summernote({
        tabsize: 2,
        height:150,
        codeview: true,
        codeviewFilter: false,
        codeviewIframeFilter: false,
        prettifyHtml: false,
        toolbar: [

            ['addbutton', ['addbutton']],
            ['addFacebook', ['addFacebook']],
            ['addLinkedIn', ['addLinkedIn']],
            ['addInsta', ['addInsta']],

            ['addFacebookDark', ['addFacebookDark']],
            ['addLinkedInDark', ['addLinkedInDark']],
            ['addInstaDark', ['addInstaDark']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ['style', ['style']],
        ],
        buttons: {
            addbutton: addButton,
            addFacebook: addFacebook,
            addLinkedIn: addLinkedIn,
            addInsta: addInsta,
            addFacebookDark: addFacebookDark,
            addLinkedInDark: addLinkedInDark,
            addInstaDark: addInstaDark
        },
        lang: 'NL',
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
        callbacks: {
            onPaste: function(e) {
                e.preventDefault();
                const clipboardData = (e.originalEvent || e).clipboardData;
                const html = clipboardData.getData('text/html') || clipboardData.getData('text/plain');
                document.execCommand('insertHTML', false, html);
            }
        }
    });

        function showColumns() {
            jQuery('#add-column-modal').modal('show');
        }

        const randomId = function (length = 6) {
            return Math.random().toString(36).substring(2, length + 2);
        };

        function addColumn(e) {
            const id = jQuery(e).attr('id');

            const blockrow = '.block-row';
            const randomId = function (length = 6) {
                return Math.random().toString(36).substring(2, length + 2);
            };

            let randomOneColumnId = randomId(5);
            let randomTwoColumnId = randomId(5);
            let randomThreeColumnId = randomId(5);
            let randomFourColumnId = randomId(5);

            if (id === 'column-1') {
                jQuery(blockrow).append("<div class='full-width-box' wire:sortable.item='" + randomOneColumnId + "' wire:key='" + randomOneColumnId + "' id='full-width-box-" + randomOneColumnId + "'><div class='container row-container' id='container-" + randomOneColumnId + "'><div id='" + randomOneColumnId + "' style='min-height:100px; border:1px grey dashed' class='one-columns-row row added-block-row'>");
                jQuery('#' + randomOneColumnId).append("" +
                    "<div class='col-12 added-column added-column-1' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'>" +
                    "<i class='edit-columns-row-icon bx bx-edit'></i>" +
                    "</div>" +
                    "</div>"
                );
                jQuery('#full-width-box-' + randomOneColumnId).append(
                    '<div class="delete-columns-row" id="' + randomOneColumnId + '" onclick="deleteColumn(this)"><i class="delete-columns-row-icon bx bx-trash"></i></div>' +
                    "<div class='edit-parent-column' id='" + randomOneColumnId + "' onclick='editColumnRow(this)'><i class='edit-column-row-icon bx bx-edit'></i></div>" +
                    "<div class='sortable-handle' wire:sortable.handle><i class='edit-column-row-icon bx bx-move'></i></div>"
                );
                jQuery(blockrow).append(
                    "</div></div></div>");
            }
            if (id === 'column-2') {
                jQuery(blockrow).append("<div wire:sortable.item='" + randomOneColumnId + "' wire:key='" + randomOneColumnId + "' class='full-width-box' id='full-width-box-" + randomOneColumnId + "'><div class='container row-container' id='container-" + randomOneColumnId + "'><div id='" + randomTwoColumnId + "' class='two-columns-row row added-block-row' style='min-height:100px; border:1px grey dashed'>");
                jQuery('#' + randomTwoColumnId).append("<div class='col-12 col-md-6 added-column added-column-2' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomTwoColumnId).append("<div class='col-12 col-md-6 added-column added-column-2' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>"
                );
                jQuery('#full-width-box-' + randomOneColumnId).append(
                    '<div class="delete-columns-row" id="' + randomOneColumnId + '" onclick="deleteColumn(this)"><i class="delete-columns-row-icon bx bx-trash"></i></div>' +
                    "<div class='edit-parent-column' id='" + randomOneColumnId + "' onclick='editColumnRow(this)'><i class='edit-column-row-icon bx bx-edit'></i></div>" +
                    "<div class='sortable-handle' wire:sortable.handle><i class='edit-column-row-icon bx bx-move'></i></div>"
                );
                jQuery(blockrow).append("</div></div></div>");
            }
            if (id === 'column-3') {
                jQuery(blockrow).append("<div wire:sortable.item='" + randomOneColumnId + "' wire:key='" + randomOneColumnId + "' class='full-width-box' id='full-width-box-" + randomOneColumnId + "'><div class='container row-container' id='container-" + randomOneColumnId + "'><div id='" + randomThreeColumnId + "' style='min-height:100px; border:1px grey dashed' class='three-columns-row row added-block-row'>");
                jQuery('#' + randomThreeColumnId).append("<div class='col-12 col-md-4 added-column added-column-3' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomThreeColumnId).append("<div class='col-12 col-md-4 added-column added-column-3' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomThreeColumnId).append("<div class='col-12 col-md-4 added-column added-column-3' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");
                jQuery('#full-width-box-' + randomOneColumnId).append(
                    '<div class="delete-columns-row" id="' + randomOneColumnId + '" onclick="deleteColumn(this)"><i class="delete-columns-row-icon bx bx-trash"></i></div>' +
                    "<div class='edit-parent-column' id='" + randomOneColumnId + "' onclick='editColumnRow(this)'><i class='edit-column-row-icon bx bx-edit'></i></div>" +
                    "<div class='sortable-handle' wire:sortable.handle><i class='edit-column-row-icon bx bx-move'></i></div>"
                );
                jQuery(blockrow).append("</div></div></div>");
            }
            if (id === 'column-4') {
                jQuery(blockrow).append("<div wire:sortable.item='" + randomOneColumnId + "' wire:key='" + randomOneColumnId + "' class='full-width-box' id='full-width-box-" + randomOneColumnId + "'><div class='container row-container' id='container-" + randomOneColumnId + "'><div id='" + randomFourColumnId + "' style='min-height:100px; border:1px grey dashed' class='four-columns-row row added-block-row'>");
                jQuery('#' + randomFourColumnId).append("<div class='col-12 col-md-6 col-lg-3 added-column added-column-4' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomFourColumnId).append("<div class='col-12 col-md-6 col-lg-3 added-column added-column-4' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomFourColumnId).append("<div class='col-12 col-md-6 col-lg-3 added-column added-column-4' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");

                jQuery('#' + randomFourColumnId).append("<div class='col-12 col-md-6 col-lg-3 added-column added-column-4' id='" + randomId(5) + "'>" +
                    "<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>" +
                    "<div class='edit-columns-row' id='" + randomId(5) + "' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>" +
                    "</div>");
                jQuery('#full-width-box-' + randomOneColumnId).append(
                    '<div class="delete-columns-row" id="' + randomOneColumnId + '" onclick="deleteColumn(this)"><i class="delete-columns-row-icon bx bx-trash"></i></div>' +
                    "<div class='edit-parent-column' id='" + randomOneColumnId + "' onclick='editColumnRow(this)'><i class='edit-column-row-icon bx bx-edit'></i></div>" +
                    "<div class='sortable-handle' wire:sortable.handle><i class='edit-column-row-icon bx bx-move'></i></div>"
                );
                jQuery(blockrow).append("</div></div></div>");
            }
            jQuery('#add-column-modal').modal('hide');
        }

        function addBlockItem(e) {
            jQuery('#add-block-item-modal').modal('show');
            columnId = jQuery(e).parent('div').attr('id');
        }

        function setBlockItemType(e) {
            jQuery('.block-item-type').removeClass('active');
            const id = jQuery(e).attr('id');
            jQuery(e).addClass('active');
            const errorMessage = '.error-message.select-block-item';
            jQuery(errorMessage).addClass('hidden');
        }

        function addBlockItemType(e) {
            const selectedBlockItem = jQuery('input[name=blockItemType]:checked').val();
            const errorMessage = '.error-message.select-block-item';
            jQuery(errorMessage).addClass('hidden');

            const randomId = function (length = 6) {
                return Math.random().toString(36).substring(2, length + 2);
            };
            const randomIds = randomId(5);

            if (!selectedBlockItem) {
                jQuery(errorMessage).removeClass('hidden');

            } else if (selectedBlockItem === 'text-block-item') {

                jQuery('#' + columnId).append('<div class="block-texteditor block-value" id="block-' + randomIds + '"></div>');
                jQuery('#add-block-item-modal').modal('hide');
                jQuery('#block-' + randomIds).summernote({
                    tabsize: 2,
                    height:150,
                    codeview: true,
                    codeviewFilter: false,
                    codeviewIframeFilter: false,
                    prettifyHtml: false,
                    toolbar: [

                        ['addbutton', ['addbutton']],
                        ['addFacebook', ['addFacebook']],
                        ['addLinkedIn', ['addLinkedIn']],
                        ['addInsta', ['addInsta']],

                        ['addFacebookDark', ['addFacebookDark']],
                        ['addLinkedInDark', ['addLinkedInDark']],
                        ['addInstaDark', ['addInstaDark']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                        ['style', ['style']],
                    ],
                    buttons: {
                        addbutton: addButton,
                        addFacebook: addFacebook,
                        addLinkedIn: addLinkedIn,
                        addInsta: addInsta,
                        addFacebookDark: addFacebookDark,
                        addLinkedInDark: addLinkedInDark,
                        addInstaDark: addInstaDark
                    },
                    lang: 'NL',
                    popover: {
                        image: [
                            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageAttributes']],
                        ],
                    },
                    callbacks: {
                        onPaste: function(e) {
                            e.preventDefault();
                            const clipboardData = (e.originalEvent || e).clipboardData;
                            const html = clipboardData.getData('text/html') || clipboardData.getData('text/plain');
                            document.execCommand('insertHTML', false, html);
                        }
                    }
                });
            } else if (selectedBlockItem === 'afbeelding-block-item') {

                jQuery('.add-block-item').remove();

                jQuery('#add-block-item-modal').modal('hide');
                jQuery('#' + columnId).append('<div class="block-imageeditor block-value" id="block-' + randomIds + '">' +
                    '<input class="upload-file" id="imgInp-' + randomIds + '" type="file" onchange="previewFile(this)" accept="image/png, image/jpeg, image/jpg" />' +
                    ' <img id="preview-image-' + randomIds + '" alt="Decodoors - afbeelding" class="previewImg hidden" src=""/>' +
                    '</div>');

            } else if(selectedBlockItem === 'slider') {
                jQuery('.add-block-item').remove();
                jQuery('#' + columnId).append('<div class="block-slider block-value" id="block-' + randomIds + '">' +
                    '<input class="upload-file" id="imgInp-' + randomIds + '" alt="Decodoors slider afbeelding" type="file" onchange="previewSliderFile(this)" accept="image/png, image/jpeg, image/jpg" />' +
                    '<div class="slider-image" id="custom-slider-'+randomIds+'">'+
                    '<div class="container slider-container"><div class="slider-text"></div></div>'+
                    '</div>'+
                    '</div>');

            } else if(selectedBlockItem === 'impression') {
                jQuery('.add-block-item').remove();
                jQuery('#' + columnId).append('<div class="block-impressions block-value" id="block-' + randomIds + '"></div>');
                jQuery('#block-' + randomIds).load('impressions');
            }

            else if(selectedBlockItem === 'review') {
                jQuery('.add-block-item').remove();
                jQuery('#' + columnId).append('<div class="block-reviews block-value" id="block-' + randomIds + '"></div>');
                jQuery('#block-' + randomIds).load('reviews');
            }

            else if(selectedBlockItem === 'contact') {
                jQuery('.add-block-item').remove();
                jQuery('#' + columnId).append('<div class="block-contact-form block-value" id="block-' + randomIds + '"></div>');
                jQuery('#block-' + randomIds).load('contactForm');
            }


        }
        function previewSliderFile(e) {
            let file = jQuery(e).get(0).files[0];
            let id = jQuery(e).attr('id').replace('imgInp-', '');
            if (file) {

                console.log(file);


                let reader = new FileReader();

                reader.onload = function () {
                    jQuery('#custom-slider-' + id).css('background-image', 'url("'+reader.result+'")');
                }
                reader.readAsDataURL(file);
            }
        }

        function previewFile(e) {
            let file = jQuery(e).get(0).files[0];
            let id = jQuery(e).attr('id').replace('imgInp-', '');
            if (file) {
                jQuery('#preview-image-' + id).removeClass('hidden');
                let reader = new FileReader();

                reader.onload = function () {
                    jQuery('#preview-image-' + id).attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

    let impressions = jQuery('#impression-placeholder').load('impressions');
    let reviews = jQuery('#review-placeholder').load('reviews');
    let contactForm = jQuery('#contact-placeholder').load('contactForm');

        function saveBlocksToDatabase() {
            const arr = [];
            let blockId = [];
            let files = [];

            //get value of new added blocks;
            jQuery('.block-row').children().each((index, element) => {

                let classnamecolumn = jQuery(element).find('div.added-block-row').attr('class');
                let id = jQuery(element).attr('id');
                console.log(element);

                if(id !== undefined) {
                    let filteredId = id.replace('full-width-box-', '');
                    blockId.push(filteredId);

                    let containerStyle = jQuery('#container-' + filteredId).attr('style');
                    let fullWidthBoxStyle = jQuery('#full-width-box-' + filteredId).attr('style');


                    let child = jQuery(element).find('div.added-block-row').attr('id');
                    let html = '<div class="full-width-box" wire:sortable.item="' + filteredId + '" wire:key="' + filteredId + '" id="full-width-box-' + filteredId + '" style="' + fullWidthBoxStyle + '"> <div class="container row-container" id="container-' + filteredId + '" style="' + containerStyle + '">';

                    html += "<div id='" + child + "' class='" + classnamecolumn + "'>";
                    jQuery('#' + child).children().each((index, element2) => {

                        let classname2 = jQuery(element2).attr('class');
                        let styleAddedColumn = jQuery(element2).attr('style');


                        if (classname2 !== 'delete-columns-row' && classname2 !== 'edit-parent-column') {
                            let textareaId = jQuery(element2).find('div.block-texteditor').attr('id');
                            let blockValueId = jQuery(element2).find('div.block-value').attr('id');
                            let blockValueClass = jQuery(element2).find('div.block-value').attr('class');
                            jQuery('#' + blockValueId).css('display', 'block');
                            let id2 = jQuery(element2).attr('id');

                            let style = jQuery('#' + blockValueId).attr('style');

                            if (!style) {
                                style = '';
                            }

                            let imageId = jQuery('#' + blockValueId).find('.upload-file').attr('id');




                            let textareaValue = jQuery('#' + textareaId).summernote('code');

                            let blockValue = jQuery('#' + id2).find('div.block-value').html();

                            let imageName;
                            if (jQuery('#' + imageId).val()) {

                                let imageFile = jQuery('#' + imageId).get(0).files[0];
                                files.push(imageFile);
                                imageName = imageFile.name;
                            }

                            let editedText = textareaValue;
                            jQuery('#' + imageId).remove();



                            let oldText = jQuery('#' + id2).find('div.block-texteditor').html();
                            html += '<div class="' + classname2 + '" style="' + styleAddedColumn + '" id="' + id2 + '">';
                            html += "<div class='edit-columns-row' onclick='editColumn(this)'><i class='edit-columns-row-icon bx bx-edit'></i></div>";
                            if (oldText) {
                                if (textareaValue instanceof jQuery) {
                                    textareaValue = oldText;
                                }
                                html += '<div class="block-texteditor block-value" style="' + style + '"  id="block-' + id2 + '">' + textareaValue + '</div>';
                                html += "<div class='edit-block' onclick='editBlock(this)' id='edit-block-" + id2 + "'><i  class='edit-block-icon bx bx-edit'></i></div>";
                                html += "<div class='cancel-block' onclick='removeblock(this)' id='edit-block-" + id2 + "'><i  class='remove-block-icon bx bx-trash'></i></div>";

                            } else if (textareaId) {

                                if (editedText) {
                                    html += '<div class="block-texteditor block-value" style="' + style + '"  id="block-' + id2 + '">' + editedText + '</div>';
                                    html += "<div class='edit-block' onclick='editBlock(this)' id='edit-block-" + id2 + "'><i  class='edit-block-icon bx bx-edit'></i></div>";
                                    html += "<div class='cancel-block' onclick='removeblock(this)' id='edit-block-" + id2 + "'><i  class='remove-block-icon bx bx-trash'></i></div>";

                                }
                            }

                            else if (imageId) {
                                html += '<div class="' + blockValueClass + '" style="' + style + '"  id="block-' + id2 + '">';

                                let customClass;

                                if (blockValueClass !== undefined) {
                                    if (blockValueClass.includes('slider')) {
                                        customClass = 'slider-image';
                                    }
                                    if (blockValueClass.includes('image')) {
                                        customClass = 'preview-image';
                                    }
                                }

                                if (customClass) {
                                    if (customClass.includes('slider-image')) {
                                        let container = jQuery('#' + blockValueId).find('div.slider-text').html();

                                        if(container === undefined) {
                                            container = '';
                                        }

                                        html += '<div class="previewImg ' + customClass + '" id="preview-image-' + id2 + '" style="background:linear-gradient(to right, #dea85fbd, #291d1b),  url(/public/storage/images/frontend/uploads/' + imageName + ')">';
                                        html += '<div class="container slider-container"><div class="slider-text">' + container + '</div></div></div>';

                                    }
                                    if (customClass.includes('preview-image')) {
                                        html += '<img alt="Escaperoom - afbeelding" id="preview-image-' + id2 + '" class="previewImg" src="{{asset('storage/images/frontend/uploads/')}}/' + imageName + '">'
                                    }
                                }

                                html += '</div>';
                                html += "<div class='edit-block' onclick='editBlock(this)' id='edit-block-" + id2 + "'><i  class='edit-block-icon bx bx-edit'></i></div>";
                                html += "<div class='cancel-block' onclick='removeblock(this)' id='edit-block-" + id2 + "'><i  class='remove-block-icon bx bx-trash'></i></div>";

                            }


                            else if (!imageId && blockValue && !blockValueClass.includes('block-impressions') && !blockValueClass.includes('block-reviews')&& !blockValueClass.includes('block-contact-form')) {
                                html += '<div class="' + blockValueClass + '" style="' + style + '"  id="block-' + id2 + '">' + blockValue + '</div>';
                                html += "<div class='edit-block' onclick='editBlock(this)' id='edit-block-" + id2 + "'><i  class='edit-block-icon bx bx-edit'></i></div>";
                                html += "<div class='cancel-block' onclick='removeblock(this)' id='edit-block-" + id2 + "'><i  class='remove-block-icon bx bx-trash'></i></div>";


                            }
                            else if(blockValueClass !== undefined && !imageId) {
                                if (blockValueClass.includes('block-impressions')) {
                                    html += '<div class="block-impressions block-value" style="' + style + '"  id="block-' + id2 + '">';
                                    html += '</div>';
                                }

                                if (blockValueClass.includes('block-reviews')) {
                                    html += '<div class="block-reviews block-value" style="' + style + '"  id="block-' + id2 + '">';
                                    html += '</div>';
                                }

                                if (blockValueClass.includes('block-contact-form')) {
                                    html += '<div class="block-contact-form block-value" style="' + style + '"  id="block-' + id2 + '">';
                                    html += '</div>';
                                }
                            }

                            else {

                                html += "<i class='bx bx-plus add-block-item' onClick='addBlockItem(this)'></i>";
                            }

                            html += '</div>';
                        }
                    });
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="delete-columns-row" id="' + filteredId + '" onclick="deleteColumn(this)"><i class="delete-columns-row-icon bx bx-trash"></i></div>';
                    html += '<div class="edit-parent-column" id="' + filteredId + '" onclick="editColumnRow(this)"><i class="edit-column-row-icon bx bx-edit"></i></div>';
                    html += "<div class='sortable-handle' wire:sortable.handle><i class='edit-column-row-icon bx bx-move'></i></div>";
                    html += '</div>';


                    arr.push(html);
                }
            });


            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let data = new FormData();
            jQuery.each(files, function (key, value) {
                data.append(key, value);
            });

            if (arr.length > 0) {

                jQuery.ajax({
                    type: 'POST',
                    url: "/save-blocks",
                    dataType: 'json',
                    data: {
                        'array': arr,
                        'blockId': blockId,
                        'pageId' : '{{$this->page->id}}',
                    },
                    success: function (data) {

                    }
                });

                console.log(files);


                if (files.length > 0) {
                    console.log(files);

                    jQuery.ajax({
                        type: 'POST',
                        processData: false,
                        url: "/save-block-images",
                        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        data: data,
                        success: function (data) {

                        }
                    });
                }
                location.reload();
            }
        }

        function editBlock(e) {

            const val = jQuery(e).parent('div').find('div.block-value').html();

            const typeBlock = jQuery(e).parent('div').find('div.block-value').attr('class');
            const blockid = jQuery(e).parent('div').find('div.block-value').attr('id');
            let selector = jQuery('#' + blockid);
            let parentId = selector.parent('div').attr('id');

            let parentSelector = jQuery('#' + parentId);

            const randomId = function (length = 6) {
                return Math.random().toString(36).substring(2, length + 2);
            };
            const randomIds = randomId(5);


            parentSelector.append('<button type="button" class="cancel-edit-block btn btn-danger">Annuleren</button>');

            console.log(e);

            if (typeBlock.includes("texteditor")) {
                parentSelector.find('div.note-editor').removeClass('hidden');

                jQuery('#' + blockid).summernote({
                    tabsize: 2,
                    height:150,
                    codeview: true,
                    codeviewFilter: false,
                    codeviewIframeFilter: false,
                    prettifyHtml: false,
                    toolbar: [

                        ['addbutton', ['addbutton']],
                        ['addFacebook', ['addFacebook']],
                        ['addLinkedIn', ['addLinkedIn']],
                        ['addInsta', ['addInsta']],

                        ['addFacebookDark', ['addFacebookDark']],
                        ['addLinkedInDark', ['addLinkedInDark']],
                        ['addInstaDark', ['addInstaDark']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                        ['style', ['style']],
                    ],
                    buttons: {
                        addbutton: addButton,
                        addFacebook: addFacebook,
                        addLinkedIn: addLinkedIn,
                        addInsta: addInsta,
                        addFacebookDark: addFacebookDark,
                        addLinkedInDark: addLinkedInDark,
                        addInstaDark: addInstaDark
                    },
                    lang: 'NL',
                    popover: {
                        image: [
                            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageAttributes']],
                        ],
                    },
                    callbacks: {
                        onPaste: function(e) {
                            e.preventDefault();
                            const clipboardData = (e.originalEvent || e).clipboardData;
                            const html = clipboardData.getData('text/html') || clipboardData.getData('text/plain');
                            document.execCommand('insertHTML', false, html);
                        }
                    }
                });


            }

            if (typeBlock.includes("imageeditor") ) {
                selector.html('');
                jQuery('#' + blockid).html('' +
                    '<input class="upload-file" id="imgInp-' + randomIds + '" style="margin-bottom: 30px; margin-top: 30px;" type="file" onChange="previewFile(this)" accept="image/png, image/jpeg, image/jpg" />' +
                    '<img alt="Decodoors afbeelding" id="preview-image-' + randomIds + '" class="previewImg hidden" src="">');
            }

            if(typeBlock.includes("slider")) {

                let slidercontainer = jQuery('#'+blockid).find('div.slider-text').html();
                selector.html('');
                jQuery('#' + blockid).html('' +
                    '<input class="upload-file" id="imgInp-' + randomIds + '" style="margin-bottom: 30px; margin-top: 30px;" type="file" onChange="previewSliderFile(this)" accept="image/png, image/jpeg, image/jpg" />' +
                     '<div class="slider-image" id="custom-slider-'+randomIds+'">'+
                    '<div class="container slider-container"><div class="slider-text">'+slidercontainer+'</div></div>'+
                    '</div>');
            }

            jQuery('.cancel-edit-block').click(function (e) {
                jQuery(this).remove();
                selector.html(val);
                selector.summernote('code', val);
                selector.css('display', 'block');
                parentSelector.find('div.note-editor').addClass('hidden');
            });
        }

        function removeblock(e) {

            if (confirm("Weet je zeker dat je dit blok wil verwijderen?")) {
                let parendId = (jQuery(e).parent('div').attr('id'));
                let blockValue = jQuery('#' + parendId).find('div.block-value');
                jQuery(blockValue).remove();

                jQuery('#' + parendId).append("<i class='bx bx-plus add-block-item' onclick='addBlockItem(this)'></i>");
                jQuery(e).remove();
                jQuery('#' + parendId).find('div.edit-block').remove();
            }
        }

        let editId;
        let editParentColumnId;

        function editColumn(e) {
            jQuery('#edit-column-modal').modal('show');
            let columnId = jQuery(e).next('div').attr('id');
            let blockClass = jQuery(e).next('div').attr('class');

            if(blockClass !== undefined)
            {
                if (blockClass.includes('block-slider')) {
                    jQuery('.slider-accordion-item').removeClass('hidden');
                    let sliderText = jQuery('#'+columnId).find('div.slider-text').html();

                    jQuery('#edit-slider-text').summernote('code', sliderText);

                } else {
                    jQuery('.slider-accordion-item').addClass('hidden');
                }
            }

            let existingColor = jQuery('#' + columnId).css('background-color');
            let padding = jQuery('#' + columnId).css('padding');

            let marginTop = jQuery('#' + columnId).css('margin-top');
            let marginLeft = jQuery('#' + columnId).css('margin-left');
            let marginBottom = jQuery('#' + columnId).css('margin-bottom');
            let marginRight = jQuery('#' + columnId).css('margin-right');

            if(existingColor !== undefined) {
                let hex = rgb2hex(existingColor);
                //set existing values
                if (hex !== '#000000') {

                    jQuery('input#edit-column-color').val(hex);
                } else {
                    jQuery('input#edit-column-color').val('#f7f5f3');
                }
            }else {
                jQuery('input#edit-column-color').val('#f7f5f3');
            }

            if(padding !== undefined) {
                jQuery('input#edit-column-padding').val(padding.substring(0, padding.length - 2));
            }
             if(marginLeft !== undefined) {
                 jQuery('input#edit-column-margin-left').val(marginLeft.substring(0, marginLeft.length - 2));
             }
            if(marginRight !== undefined) {
                jQuery('input#edit-column-margin-right').val(marginRight.substring(0, marginRight.length - 2));
            }
            if(marginTop !== undefined) {
                jQuery('input#edit-column-margin-top').val(marginTop.substring(0, marginTop.length - 2));
            }
            if(marginBottom !== undefined) {
                jQuery('input#edit-column-margin-bottom').val(marginBottom.substring(0, marginBottom.length - 2));
            }
            editId = columnId;
        }

        function saveEditedColumn() {

            let backgroundColor = jQuery('#edit-column-color').val();
            let padding = jQuery('#edit-column-padding').val();

            let marginLeft = jQuery('#edit-column-margin-left').val();
            let marginRight = jQuery('#edit-column-margin-right').val();
            let marginTop = jQuery('#edit-column-margin-top').val();
            let marginBottom = jQuery('#edit-column-margin-bottom').val();
            let sliderText = jQuery('#edit-slider-text').val();


            if(sliderText) {
                jQuery('#' + editId).find('div.slider-text').html(sliderText);
            }

            if (backgroundColor) {
                jQuery('#' + editId).attr('style', 'background-color:' + backgroundColor);
            }


            if (padding) {
                jQuery('#' + editId).css('padding', padding + 'px');
            }

            jQuery('#' + editId).css('margin-left', marginLeft + 'px');
            jQuery('#' + editId).css('margin-right', marginRight + 'px');
            jQuery('#' + editId).css('margin-top', marginTop + 'px');
            jQuery('#' + editId).css('margin-bottom', marginBottom + 'px');

            jQuery('#' + editId).css('padding', padding + 'px');

            jQuery('#edit-column-modal').modal('hide');
        }

        function deleteColumn(e) {
            let id = jQuery(e).attr('id');

            if (confirm("Weet je zeker dat je deze column wil verwijderen? Alle blokken in de column worden ook verwijderd.")) {
                jQuery('#full-width-box-' + id).remove();
            } else {
                e.preventDefault();
            }
        }

        function editColumnRow(e) {
            editParentColumnId = jQuery(e).attr('id');


            jQuery('#edit-parent-column-modal').modal('show');
            let existingColumnColor = jQuery('#full-width-box-' + editParentColumnId).css('background-color');

            console.log(existingColumnColor);

            let padding = jQuery('#container-' + editParentColumnId).css('padding');

            let breedte = jQuery('#full-width-box-' + editParentColumnId).css('max-width');

            let marginTop = jQuery('#full-width-box-' + editParentColumnId).css('margin-top');
            let marginLeft = jQuery('#full-width-box-' + editParentColumnId).css('margin-left');
            let marginBottom = jQuery('#full-width-box-' + editParentColumnId).css('margin-bottom');
            let marginRight = jQuery('#full-width-box-' + editParentColumnId).css('margin-right');
            let innerBreedte = jQuery('#container-' + editParentColumnId).css('max-width');



            if (existingColumnColor !== undefined) {
                let hex = rgb2hex(existingColumnColor);

                if (hex !== '#000000') {

                    jQuery('input#edit-parent-column-color').val(hex);
                } else {
                    jQuery('input#edit-parent-column-color').val('#f7f5f3');
                }
            }else {
                jQuery('input#edit-parent-column-color').val('#f7f5f3');
            }


            if (padding !== undefined) {
                jQuery('input#edit-parent-column-padding').val(padding.substring(0, padding.length - 2));
            }

            if (breedte !== 'none') {
                jQuery('input#edit-parent-column-breedte').val(breedte);
            }

            if (innerBreedte !== 'none') {
                jQuery('input#edit-parent-column-inner-breedte').val(innerBreedte);
            }
            if (marginLeft !== undefined) {
                jQuery('input#edit-parent-column-margin-left').val(marginLeft.substring(0, marginLeft.length - 2));
            }
            if (marginRight !== undefined) {
                jQuery('input#edit-parent-column-margin-right').val(marginRight.substring(0, marginRight.length - 2));
            }
            if (marginTop !== undefined) {
                jQuery('input#edit-parent-column-margin-top').val(marginTop.substring(0, marginTop.length - 2));
            }
            if (marginBottom !== undefined) {
                jQuery('input#edit-parent-column-margin-bottom').val(marginBottom.substring(0, marginBottom.length - 2));
            }

        }

        function saveEditedParentColumn() {
            let backgroundColor = jQuery('#edit-parent-column-color ').val();
            let padding = jQuery('#edit-parent-column-padding ').val();
            let breedte = jQuery('#edit-parent-column-breedte').val();
            let innnerBreedte = jQuery('#edit-parent-column-inner-breedte').val();

            let marginLeft = jQuery('input#edit-parent-column-margin-left').val();
            let marginRight = jQuery('input#edit-parent-column-margin-right').val();
            let marginTop = jQuery('input#edit-parent-column-margin-top').val();
            let marginBottom = jQuery('input#edit-parent-column-margin-bottom').val();


            if (backgroundColor) {
                jQuery('#full-width-box-' + editParentColumnId).attr('style', 'background-color:' + backgroundColor);
            }

            if (padding) {
                jQuery('#container-' + editParentColumnId).css('padding', padding + 'px');
            }

            //max-breedte outer column
            if (breedte !== 'none') {
                jQuery('#full-width-box-' + editParentColumnId).css('max-width', breedte);
            }

            if (innnerBreedte !== 'none') {

                jQuery('#container-' + editParentColumnId).css('max-width', innnerBreedte);
            }

            if(innnerBreedte === '100%') {
                jQuery('#container-' + editParentColumnId).find('div.added-column').css('padding', '0px');
            }

            let fullBoxSelector = jQuery('#full-width-box-' + editParentColumnId);


            fullBoxSelector.css('margin-left', marginLeft + 'px');
            fullBoxSelector.css('margin-right', marginRight + 'px');
            fullBoxSelector.css('margin-top', marginTop + 'px');
            fullBoxSelector.css('margin-bottom', marginBottom + 'px');

            jQuery('#edit-parent-column-modal').modal('hide');
        }

        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
            return (rgb && rgb.length === 4) ? "#" +
                ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
        }



</script>
