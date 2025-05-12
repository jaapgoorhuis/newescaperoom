
<form class="row g-3 needs-validation" id="contact-form" novalidate>
    <div class="col-12 col-md-6 form-column">
        <input type="text" wire:model="voornaam_contact" class="form-control" placeholder="Voornaam" id="validationCustom01" required>
    </div>

    <div class="col-12 col-md-6 form-column">

        <input type="text" wire:model="achternaam_contact" placeholder="Achternaam" class="form-control" id="validationCustom02" required>

    </div>

    <div class="col-12 col-md-6 form-column">

        <input type="tel" wire:model="telefoonnummer_contact" placeholder="Telefoonnummer"  class="form-control" id="validationCustom03">

    </div>

    <div class="col-12 col-md-6 form-column">
        <input type="email" wire:model="email_contact" class="form-control" placeholder="E-mailadres" id="validationCustom04" required>
    </div>

    <div class="col-12 col-md-12 form-column">
        <textarea wire:model="bericht_contact" class="form-control" placeholder="Bericht" id="validationCustom05" ></textarea>
    </div>

    <div class="col-12 col-md-12 form-column">
        <div class="form-check">
            <input wire:model="privacy_contact" class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
                Ik ga akkoord met de <a class="striped-link" href="/privacyverklaring">privacyverklaring</a>
            </label>
        </div>
    </div>

    <div id="succes-alert" class="hidden contact-alert alert alert-success alert-warning alert-dismissible fade show" role="alert">
        Het contactformulier is succesvol verstuurd! Wij nemen zo snel mogelijk contact met u op.
        <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


    <div class="col-12 form-column">
        <button type="submit" class="btn-primary btn magazine-btn" wire:click="storeContact">Verzenden</button>
    </div>

</form>



<script>


    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()

                    form.classList.add('was-validated');
                } else {

                    event.preventDefault()
                   jQuery('.contact-alert').removeClass('hidden');
                    form.classList.remove('was-validated');
                    setTimeout(() => {
                        form.classList.remove("was-validated");
                    });
                    form.reset();
                }

            }, false)


        })


    })()

</script>
