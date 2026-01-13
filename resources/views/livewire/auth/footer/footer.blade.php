<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Footer</p>
                </div>
                @if(Session::has('success'))
                    <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Footer:</h5>
                        <br/>
                        <div class="form-section">
                            @for($i =1; $i <2; $i++)
                                <?php
                                    $indicater = 'type_column_'.$i;
                                    $column = 'column_'.$i;
                                    $typeColumn = 'column_'.$i.'_type';
                                    $imageColumn = 'column_'.$i.'_image';
                                    $textColumn = 'column_'.$i.'_text';
                                ?>

                                <div class="form-group mb-3">
                                    <label for="route">Column {{$i}}:</label><br/>
                                    <small class="sub-label-admin">Selecteer wat je in de column wil plaatsen</small>
                                    <select wire:model.live="{{$indicater}}" wire:change="toggleColumnSelector()" class="form-control">
                                        <option value="">Maak keuze:</option>
                                        <option @if($typeColumn == 'text') selected @endif value="text">Tekst</option>
                                        <option @if($typeColumn == 'image') selected @endif value="image">Afbeelding</option>
                                    </select>
                                    @error($indicater)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if($this->$indicater == 'text')
                                <div wire:ignore.self>
                                    <div class="form-group mb-3" wire:ignore>
                                        <label for="{{$textColumn}}">Tekst column {{$i}}:</label><br/>
                                        <small class="sub-label-admin">Dit is de tekst in de footer in column {{$i}} (vanaf links)</small>
                                        <textarea id="{{$textColumn}}" wire:model.live="{{$textColumn}}"></textarea>
                                        @error($textColumn)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif

{{--                                @if($this->$indicater == 'image')--}}
{{--                                    <div>--}}
{{--                                        <div class="form-group mb-3">--}}
{{--                                            <label for="{{$imageColumn}}">Afbeelding column {{$i}}:</label><br/>--}}
{{--                                            <small class="sub-label-admin">Dit is de afbeelding in de footer in column {{$i}} (vanaf links)</small><br/>--}}
{{--                                            <input class="image_column_1" id="{{$imageColumn}}" wire:change="resetExistingImage('{{$i}}')" wire:model="{{$imageColumn}}" type="file" accept="image/png, image/jpeg, image/jpg" /><br/>--}}
{{--                                            @error($imageColumn)--}}
{{--                                            <span class="text-danger">{{ $message }}</span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        @if($this->$column)--}}
{{--                                            <label for="existing-image-{{$i}}">Bestaande afbeelding:</label><br/>--}}
{{--                                            {!! $this->$column !!}--}}
{{--                                        @endif--}}

{{--                                    </div>--}}
{{--                                @endif--}}
                                <hr class="rounded">
                            @endfor
                        </div>
                        <div class="form-group mb-3">
                            <label for="route">Laat magazine zien:</label><br/>
                            <small class="sub-label-admin">Plaats magazine in de footer</small>
                            <select wire:model.live="show_magazine" class="form-control">
                                <option @if($this->show_magazine) selected @endif value="1">Ja</option>
                                <option @if(!$this->show_magazine) selected @endif value="0">Nee</option>

                            </select>
                            @error($indicater)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="update()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
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

                    context.invoke('editor.pasteHTML', '<button class="btn btn-secondary editor-buttons">Button</button>');                }
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
                    context.invoke('editor.pasteHTML', '<a href="{{$this->settings->linkedin}}"><img src="{{asset('/storage/images/frontend/uploads/linkedin.svg')}}" class="facebook-icon" alt="facebook"/></a>');

                }
            });

            return linkedin.render(); // return button as jquery object
        }

        $('#column_1_text').summernote({
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
                manageAspectRatio: true
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

            // --- Hier voegen we de HTML-ondersteuning toe ---
            sanitize: false,          // Belangrijk: volledige HTML toegestaan
            codeviewFilter: false,    // Houdt alle HTML tags intact
            codeviewIframeFilter: true, // Laat iframe's toe in codeview
            callbacks: {
                onChange: function (contents, $editable) {
                @this.set('column_1_text', contents)
                },
                onPaste: function(e) {
                    // Zorg dat geplakte HTML behouden blijft
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertHtml', false, bufferText);
                }
            },
        });

        $('#column_2_text').summernote({
            tabsize: 2,
            height:150,
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
                @this.set('column_2_text', contents)
                }
            }
        });

        $('#column_3_text').summernote({
            tabsize: 2,
            height:150,
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
                @this.set('column_3_text', contents)
                }
            }
        });

        $('#column_4_text').summernote({
            tabsize: 2,
            height:150,
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
                @this.set('column_4_text', contents)
                }
            }
        });


    };


    document.addEventListener('refresh', () => {
        Livewire.hook('element.init', ({component, el}) => {
                initSummernoteEditor();
            $('#column_1_text').summernote('code', '<?php echo $this->column_1?>');
            $('#column_2_text').summernote('code', '<?php echo $this->column_2?>');
            $('#column_3_text').summernote('code', '<?php echo $this->column_3?>');
            $('#column_4_text').summernote('code', '<?php echo $this->column_4?>');
        });
    });

    $(function() {
        initSummernoteEditor();
        $('#column_1_text').summernote('code', '<?php echo $this->column_1?>');
        $('#column_2_text').summernote('code', '<?php echo $this->column_2?>');
        $('#column_3_text').summernote('code', '<?php echo $this->column_3?>');
        $('#column_4_text').summernote('code', '<?php echo $this->column_4?>');
    });

    let buttons = $('.note-editor button[data-toggle="dropdown"]');

    buttons.each((key, value) => {
        $(value).on('click', function (e) {
            $(this).closest('.note-btn-group').toggleClass('open');
        })
    });
    $(' ul.note-dropdown-menu.dropdown-menu').on('click', function() {
        $('.note-btn-group').removeClass('open');
    });


    $('.dropdown-menu > li ').on('click', function() {
        $('.note-btn-group').removeClass('open');
    });


    $('.note-editable').on('click', function () {
        $('.note-btn-group').removeClass('open');
    });

</script>
@endscript
