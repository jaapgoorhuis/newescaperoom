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

    <div id="succes-alert" class="hidden contact-alert alert alert-success alert-dismissible fade show" role="alert">
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

        form.addEventListener('submit', event => {
            event.preventDefault();

            // Bootstrap frontend validation
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            // Haal captcha token
            const captchaResponse = grecaptcha.getResponse();
            if (captchaResponse.length === 0) {
                jQuery('#captcha-error').show();
                form.classList.add('was-validated');
                return;
            } else {
                jQuery('#captcha-error').hide();
            }

            // Zet token in hidden input zodat Livewire dit oppikt
            const input = document.getElementById('captcha');
            input.value = captchaResponse;
            input.dispatchEvent(new Event('input', { bubbles: true }));

            // Submit wordt automatisch door Livewire afgehandeld via wire:submit.prevent
        });

        // Reset formulier bij succes via Livewire event
        window.addEventListener('contactFormSuccess', () => {
            jQuery('.contact-alert').removeClass('hidden');
            form.reset();
            form.classList.remove('was-validated');
            grecaptcha.reset();
        });

        // Toon captcha error als Livewire dat doorgeeft
        window.addEventListener('captchaError', () => {
            jQuery('#captcha-error').show();
        });
    })();
</script>
