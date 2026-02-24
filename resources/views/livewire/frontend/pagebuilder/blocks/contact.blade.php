<div class="contact-block">


    <form wire:submit.prevent="submitContactForm({{ $rowIndex }}, {{ $colIndex }}, {{ $blockIndex }})">
        <div class="row mb-2">
            <div class="col-12">
                <label>Voornaam *</label>
                <input type="text"
                       class="form-control @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.voornaam') is-invalid @enderror"
                       wire:model.defer="contactForm.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}.voornaam"
                       placeholder="Voornaam *">
                @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.voornaam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label>Achternaam *</label>
                <input type="text"
                       class="form-control @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.achternaam') is-invalid @enderror"
                       wire:model.defer="contactForm.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}.achternaam"
                       placeholder="Achternaam *">
                @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.achternaam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <label>Telefoonnummer</label>
                <input type="text"
                       class="form-control @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.telefoon') is-invalid @enderror"
                       wire:model.defer="contactForm.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}.telefoon"
                       placeholder="Telefoonnummer">
                @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.telefoon')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label>Email *</label>
                <input type="email"
                       class="form-control @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.email') is-invalid @enderror"
                       wire:model.defer="contactForm.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}.email"
                       placeholder="Email *">
                @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
            <label>Bericht *</label>
                <textarea
                    class="form-control @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.bericht') is-invalid @enderror"
                    wire:model.defer="contactForm.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}.bericht"
                    placeholder="Bericht *"
                    rows="4"></textarea>
                @error('contactForm.'. $rowIndex .'.'. $colIndex .'.'. $blockIndex .'.bericht')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="col-12 form-column" wire:ignore>
                    <div id="recaptcha-{{ $blockIndex }}"
                         class="g-recaptcha"
                         data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
                         data-callback="onCaptchaSuccess">
                    </div>
                </div>

                @error('captcha')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <div class="row mb-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">Verzenden</button>
            </div>
        </div>

    </form>

    @if(session()->has("contactSuccess.$rowIndex.$colIndex.$blockIndex"))
        <div class="alert alert-success mt-2">
            {{ session("contactSuccess.$rowIndex.$colIndex.$blockIndex") }}
        </div>
    @endif
</div>

<script>
    function renderRecaptcha() {
        if(typeof grecaptcha !== 'undefined' && !document.getElementById('recaptcha-{{ $blockIndex }}').dataset.rendered){
            grecaptcha.render('recaptcha-{{ $blockIndex }}', {
                'sitekey': '{{ env("RECAPTCHA_SITE_KEY") }}',
                'callback': onCaptchaSuccess
            });
            document.getElementById('recaptcha-{{ $blockIndex }}').dataset.rendered = true;
        }
    }

    function onCaptchaSuccess(token){
    @this.set('captcha', token);
    }

    window.addEventListener('livewire:load', function(){
        renderRecaptcha();
    });



    window.addEventListener('recaptcha-reset', function(){
        if(typeof grecaptcha !== 'undefined'){
            grecaptcha.reset();
        }
    });
</script>
