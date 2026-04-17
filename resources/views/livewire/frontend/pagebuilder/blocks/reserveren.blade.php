<div id="oa_widget" class="widget-js"></div>

<div id="booking-fallback" style="display:none; color:white;">
    Om te reserveren moet je de cookies accepteren. Klik links onderin op het cookiebot icoontje om de cookie instellingen aan te passen.
</div>


<script>
function loadBookingWidget() {
    // voorkom dubbel laden
    if (document.querySelector('#oa_script_loaded')) return;

    // fallback verbergen
    const fallback = document.getElementById('booking-fallback');
    if (fallback) fallback.style.display = 'none';

    // script laden
    var s = document.createElement("script");
    s.src = "https://widget.onlineafspraken.nl/consumer/booking/book/key/alah21oooa98-alaz00/l/a3216/ln/nl/t/8090ec/f/110d0111/o/theme:advanced,dp:modern/c/00aeef,7dc473,fff,f16522,56ac4a,111,0,fff/at/0/rs/0/pp/0/lp/1/ls/1/og/2/op/2/gp/0/gtm_tag/GTM-N643DK8M/exclude/mobiledetect/output/js";
    s.id = "oa_script_loaded";
    document.body.appendChild(s);
}

function showFallback() {
    const fallback = document.getElementById('booking-fallback');
    if (fallback) fallback.style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function () {

    if (window.Cookiebot) {
        if (Cookiebot.consented) {
            loadBookingWidget();
        } else {
            showFallback();
        }
    } else {
        // fallback als Cookiebot nog niet geladen is
        showFallback();
    }

});

// Als gebruiker alsnog keuze maakt
window.addEventListener('CookiebotOnAccept', function() {
    loadBookingWidget();
});

window.addEventListener('CookiebotOnDecline', function() {
    showFallback();
});
</script>