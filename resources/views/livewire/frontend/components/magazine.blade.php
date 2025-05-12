<div class="row">
<div class="col-12 col-md-5 magazine-column">
    <?php $magazineImage = \App\Models\Magazine::first()->getMedia('magazine')->first();?>
    <?php $magazine = \App\Models\Magazine::first();?>

    <div style="background-image:url({{$magazineImage->getUrl('magazine')}})"  class="magazine-image"></div>

</div>
    <div class="col-0 col-md-1"></div>

<div class="col-12 col-md-5 magazine-column">
    {!! $magazine->text !!}

    <form>
        <div class="row form-row">
            <div class="col-12 col-md-6 form-column">
                <input type="text" class="form-control" placeholder="Voornaam" aria-label="voornaam" wire:model="voornaam">
                @error('voornaam')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 col-md-6 form-column">
                <input type="text" class="form-control" placeholder="Achternaam" wire:model="achternaam" aria-label="achternaam">
                @error('achternaam')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row form-row">
            <div class="col-12 col-md-6 form-column">
                <input type="text" class="form-control" placeholder="Telefoonnummer" aria-label="Telefoonnummer" wire:model="telefoonnummer">
                @error('telefoonnummer')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 col-md-6 form-column">
                <input type="email" class="form-control" placeholder="E-mailadres" wire:model="email" aria-label="email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row form-row checkbox-row">
            <div class="col-12 form-column">

                <input type="checkbox" class="checkbox" wire:model="privacy" name="Privacyverklaring" />
                <label for="Privacyverklaring" class="privacy">Ik ga akkoord met de <a class="striped-link" href="/privacyverklaring">privacyverklaring</a></label><br/>
                @error('privacy')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row form-row send-row">
            <div class="col-12 form-column">
                <button class="btn-primary btn magazine-btn" wire:click.prevent="storeMagazine">
                    <i  wire:loading.class="d-inline-block" wire:target="storeMagazine" class="display-none fa fa-spinner fa-spin"></i> Verzenden</button>
            </div>
        </div>
    </form>
    @if(Session::has('success'))
        <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
</div>
