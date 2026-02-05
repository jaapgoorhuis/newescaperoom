<form wire:submit.prevent="storeContact" class="row g-3 needs-validation" id="contact-form" novalidate>
    <div class="col-12 col-md-6 form-column">
        <input type="text" wire:model="voornaam_contact" class="form-control contact-form" placeholder="Voornaam *" id="validationCustom01" required>
    </div>

    <div class="col-12 col-md-6 form-column">
        <input type="text" wire:model="achternaam_contact" placeholder="Achternaam *" class="form-control contact-form" id="validationCustom02" required>
    </div>

    <div class="col-12 col-md-6 form-column">
        <input type="tel" wire:model="telefoonnummer_contact" placeholder="Telefoonnummer" class="form-control contact-form" id="validationCustom03">
    </div>

    <div class="col-12 col-md-6 form-column">
        <input type="email" wire:model="email_contact" class="form-control contact-form" placeholder="E-mailadres *" id="validationCustom04" required>
    </div>

    <div class="col-12 col-md-12 form-column">
        <textarea wire:model="bericht_contact" class="form-control contact-form" placeholder="Bericht *" id="validationCustom05" required></textarea>
    </div>

    <div id="succes-alert" class="d-none contact-alert alert alert-success alert-dismissible fade show" role="alert">

        Het contactformulier is succesvol verstuurd! Wij nemen zo snel mogelijk contact met u op.
        <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="col-12 form-column">
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <span id="captcha-error" class="text-danger" style="display:none;">Je moet de captcha invullen</span>
    </div>

    <!-- Hidden input voor captcha -->
    <input id="captcha" type="hidden" wire:model="captcha"/>

    <div class="col-12 form-column">
        <button type="submit" class="btn-primary btn magazine-btn">
            <i wire:loading.class="d-inline-block" wire:target="storeContact" class="display-none fa fa-spinner fa-spin"></i> Verzenden
        </button>
    </div>
</form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    (() => {
        'use strict';
        const form = document.getElementById('contact-form');

        // Let op: geen event.preventDefault() op submit, Livewire submit blijft werken
        form.addEventListener('submit', event => {

            // Bootstrap frontend validatie
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                event.preventDefault(); // Alleen voorkomen als validatie faalt
                return;
            }

            // Google reCAPTCHA ophalen
            const captchaResponse = grecaptcha.getResponse();
            if (captchaResponse.length === 0) {
                jQuery('#captcha-error').show();
                form.classList.add('was-validated');
                event.preventDefault(); // blokkeren omdat captcha niet ingevuld
                return;
            } else {
                jQuery('#captcha-error').hide();
            }

            // Captcha naar hidden input sturen voor Livewire
            const input = document.getElementById('captcha');
            input.value = captchaResponse;
            input.dispatchEvent(new Event('input', { bubbles: true }));

            // Success alert & reset pas uitvoeren via Livewire event
            // Livewire moet dan dispatchBrowserEvent('contactFormSuccess') doen
        });

        // Frontend success event listener
        window.addEventListener('contactFormSuccess', () => {
            jQuery('#succes-alert').removeClass('d-none');
            form.classList.remove('was-validated');

            // Velden leegmaken
            const fields = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea');
            fields.forEach(el => {
                el.value = '';
                el.dispatchEvent(new Event('input', { bubbles: true })); // Livewire update
            });

            // captcha reset
            grecaptcha.reset();
            const captchaInput = document.getElementById('captcha');
            captchaInput.value = '';
            captchaInput.dispatchEvent(new Event('input', { bubbles: true }));
        });

        // Captcha error
        window.addEventListener('captchaError', () => {
            jQuery('#captcha-error').show();
        });
    })();

    window.addEventListener('contactFormSuccess', () => {
        jQuery('#succes-alert').removeClass('d-none');

        // Velden zijn al leeg door Livewire reset, bootstrap validatie resetten
        form.classList.remove('was-validated');

        // captcha reset
        grecaptcha.reset();
    });

    // Als je een aparte captchaReset wilt
    window.addEventListener('captchaReset', () => {
        grecaptcha.reset();
    });


</script>
