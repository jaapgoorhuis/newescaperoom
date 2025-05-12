<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Instellingen</p>
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

                            <div class="form-group mb-3">
                                <label for="lastname">Websitenaam:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="lastname" wire:model.live="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">LinkedIn url:</label>
                                <input type="text" class="form-control @error('linkedIn') is-invalid @enderror" id="linkedIn" wire:model.live="linkedIn">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">Twitter url:</label>
                                <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" wire:model.live="twitter">
                                @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">Facebook url:</label>
                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" wire:model.live="facebook">
                                @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">Instagram url:</label>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" wire:model.live="instagram">
                                @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



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
