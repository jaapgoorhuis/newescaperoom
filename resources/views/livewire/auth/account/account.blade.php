<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            @if(Session::has('success'))
                <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Gebruikersinstellingen</p>
                    <a class="close-card" href="" wire:click="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Persoonsgegevens:</h5>
                        <br/>
                        <div class="form-section">

                            <div class="form-group mb-3">
                                <label for="lastname">Naam:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="lastname" wire:model.live="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <br/>
                            <hr class="rounded">
                            <h5 class="form-section-title">Wachtwoord reset:</h5>
                            <br/>

                            <div class="form-group mb-3">
                                <label for="new_password">Nieuw wachtwoord:</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.live="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Herhaal nieuw wachtwoord:</label>
                                <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"  wire:model.live="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
