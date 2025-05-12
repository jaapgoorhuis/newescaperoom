<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Pagina toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Pagina gegevens:</h5>

                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="title">Naam van de pagina:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Homepagina" wire:model.live="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">route:</label><br/>
                                <small class="sub-label-admin">Maak deze route zo eenvoudig mogelijk</small>
                                <input class="form-control @error('route') is-invalid @enderror" id="route" wire:model.live="route" placeholder="index">
                                @error('route')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Pagina instellingen:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="is_active">Pagina actief:</label><br/>
                                <small class="sub-label-admin">Is de pagina actief op de website of niet</small>
                                <select wire:model.live="is_active" class="form-control">
                                    <option value="1" wire:selected>Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id >= 3)
                                <div class="form-group mb-3">
                                    <label for="is_removable">Pagina verwijderbaar:</label><br/>
                                    <small class="sub-label-admin">Is de pagina verwijderbaar voor gebruikers:</small>
                                    <select wire:model.live="is_removable" class="form-control">
                                        <option value="1" wire:selected>Ja</option>
                                        <option value="0">Nee</option>
                                    </select>
                                    @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif



                            <div class="form-group mb-3">
                                <label for="show_footer">Footer zichtbaar op pagina:</label><br/>
                                <small class="sub-label-admin">Voeg de footer toe aan de pagina.</small>
                                <select wire:model.live="show_footer" class="form-control">
                                    <option value="1" wire:selected>Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('show_header')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="d-grid gap-2">
                            <button wire:click.prevent="editPage()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancelPage()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        $('#header_text').summernote({
            tabsize: 2,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 150,

            callbacks: {
                onChange: function (contents, $editable) {
                @this.set('header_text', contents)
                }
            }
        });
        $("#header_text").on("summernote.enter", function (we, e) {
            $(this).summernote("pasteHTML", "<br><br>");
            e.preventDefault();
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
</div>
