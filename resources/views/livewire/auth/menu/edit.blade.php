<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Menu item toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelProject()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Menu items:</h5>
                        <br/>

                            <div class="form-section">
                                <div class="form-group mb-3">
                                    <label for="title">Menu titel:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Homepagina" wire:model.defer="title">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-3">
                                    <label for="route">Pagina koppelen:</label><br/>
                                    <small class="sub-label-admin">Selecteer de pagina die je aan dit menu item wil koppelen</small>
                                    <select wire:model.live="page_id" class="form-control">
                                        @foreach($pages as $page)
                                            <option value="{{$page->id}}">{{$page->title}}
                                        @endforeach
                                    </select>
                                    @error('page_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="route">Item zichtbaar in het menu:</label><br/>
                                    <small class="sub-label-admin">Kies of het item zichtbaar is in het menu op de website</small>
                                    <select wire:model.live="show_menu" class="form-control">
                                        <option value="1">Ja</option>
                                        <option value="0">Nee</option>
                                    </select>
                                    @error('show_menu')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                            <div class="d-grid gap-2">
                                <button wire:click.prevent="updateMenu()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                                <button wire:click.prevent="cancelMenu()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
