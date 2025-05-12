<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Magazine</p>
                </div>
                @if(Session::has('success'))
                    <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >

                        <br/>
                        <div class="form-section">

                            <div wire:ignore.self>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="text">Tekst</label><br/>
                                    <small class="sub-label-admin">Dit is de tekst in het magazine</small>
                                    <textarea id="text" wire:model="text"></textarea>
                                    @error('text')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mb-3">
                                <label for="title">Magazine afbeelding</label>
                                <x-filepond::upload
                                    multiple="false"
                                    wire:model="magazine_image"
                                />
                            </div>

                            @if($this->existing_magazine_image)
                                <hr class="rounded">
                                <label for="title">Huidige afbeelding</label>

                                <br/>
                                <div class="accordion" id="accordionExample">
                                    <ul style="list-style: none; padding:0px" >
                                        @foreach($this->existing_magazine_image as $items)
                                            <li wire:sortable.item="{{$items->id}}" wire:key="items_{{$items->id}}" wire:sortable.handle>
                                                <div class="flex-grid">
                                                    <div class="col sorting-col">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </div>
                                                    <img src="{!! $items['original_url'] !!}" style="width:150px;"/>
                                                    <div class="align-right">
                                                        <button wire:click.prevent="removeExistingFiles({{$items['id']}})" class="btn btn-danger btn-sm">Verwijderen</button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="d-grid gap-2">
                                <button wire:click.prevent="update()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script

<script>
    const initSummernoteEditor = () => {
        var addButton = function (context) {
            var ui = $.summernote.ui;

            // create button
            var button = ui.button({
                contents: '<i class="fa-solid fa-square-plus"/>',
                tooltip: 'addbutton',
                click: function () {
                    // invoke insertText method with 'hello' on editor module.

                    context.invoke('editor.pasteHTML', '<button class="btn btn-secondary editor-buttons">Button</button>');
                }
            });

            return button.render(); // return button as jquery object
        }

        var addFacebook = function (context) {
            var ui = $.summernote.ui;

            // create button
            var faceBook = ui.button({
                contents: '<i class="fa-brands fa-facebook-f"></i>',
                tooltip: 'addbutton',
                click: function () {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML', '<a href="{{$this->settings->facebook}}"><img src="{{asset('/storage/images/frontend/uploads/facebook.svg')}}" class="facebook-icon" alt="facebook"/></a>');

                }
            });

            return faceBook.render(); // return button as jquery object
        }

        var addInsta = function (context) {
            var ui = $.summernote.ui;

            // create button
            var insta = ui.button({
                contents: '<i class="fa-brands fa-instagram"></i>',
                tooltip: 'addbutton',
                click: function () {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML', '<a href="{{$this->settings->instagram}}"><img src="{{asset('/storage/images/frontend/uploads/instagram.svg')}}" class="facebook-icon" alt="instagram"/></a>');

                }
            });

            return insta.render(); // return button as jquery object
        }

        var addLinkedIn = function (context) {
            var ui = $.summernote.ui;

            // create button
            var linkedin = ui.button({
                contents: '<i class="fa-brands fa-linkedin-in"></i>',
                tooltip: 'addbutton',
                click: function () {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML', '<a href="{{$this->settings->linkedin}}"><img src="{{asset('/storage/images/frontend/uploads/linkedin.svg')}}" class="facebook-icon" alt="linkedin"/></a>');

                }
            });

            return linkedin.render(); // return button as jquery object
        }


        $('#text').summernote({
            tabsize: 2,
            height: 150,
            toolbar: [

                ['addbutton', ['addbutton']],
                ['addFacebook', ['addFacebook']],
                ['addLinkedIn', ['addLinkedIn']],
                ['addInsta', ['addInsta']],
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
                addInsta: addInsta
            },
            imageAttributes: {
                icon: '<i class="note-icon-pencil"/>',
                figureClass: 'figureClass',
                figcaptionClass: 'captionClass',
                captionText: 'Caption Goes Here.',
                manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
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
                onChange: function (contents, $editable) {

                @this.set('text', contents)
                }
            },
        });
    };

    $(function () {
        initSummernoteEditor();
        $('#text').summernote('code', '<?php echo $this->text ?>');

    });

</script>
@endscript
