<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('/css/frontapp.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/block.css')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/images/frontend/uploads/favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php  $route = \Illuminate\Support\Facades\Route::current()->slug;
            $route2 = \Illuminate\Support\Facades\Route::current()->uri();

           if($route) {
               $page = \App\Models\Page::where('route', $route)->first();
               if(!$page) {

                   $title = 'Niet gevonden';
               } else {
                   $title = $page->title;
               }
           }
           else if ($route2 == 'offerte-aanvragen') {

               $page = \App\Models\Page::where('route', 'offerte-aanvragen')->first();
               $title = $page->title;
           }
           else {
               $page = \App\Models\Page::where('route', 'index')->first();
               $title = $page->title;
           }
    ?>


    <meta name="description" content="DecoDoors.nl – Hoogwaardige houten binnendeuren op maat. Tijdloos design, vakmanschap en snelle levering. Ontdek jouw perfecte deur online!"/>

    <title>Decodoors - {{$title}}</title>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossOrigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

    <script src="{{asset('/js/frontapp.js')}}"></script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="https://kit.fontawesome.com/a865bbd52d.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
    <script src="{{asset('/js/summernote-image-attributes.js')}}"></script>
    <script src="{{asset('/js/lang/NL.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>


<script>


    jQuery(document).ready(function() {

        let loggedIn = {{ auth()->check() ? 'true' : 'false' }};
        if (loggedIn) {
            jQuery('.edit-block').removeClass('hidden');
            jQuery('.cancel-block').removeClass('hidden');
            jQuery('.edit-columns-row').removeClass('hidden');
            jQuery('.delete-columns-row').removeClass('hidden');
            jQuery('.edit-parent-column').removeClass('hidden');
            jQuery('.add-block-item').removeClass('hidden');
            jQuery('.sortable-handle').removeClass('hidden');
            jQuery('nav.navbar.navbar-expand-lg.navbar-light.bg-light.sticky-top').css('margin-top', '44px');

        } else {
            jQuery('.edit-block').addClass('hidden');
            jQuery('.cancel-block').addClass('hidden');
            jQuery('.edit-columns-row').addClass('hidden');
            jQuery('.delete-columns-row').addClass('hidden');
            jQuery('.edit-parent-column').addClass('hidden');
            jQuery('.add-block-item').addClass('hidden');
            jQuery('.sortable-handle').addClass('hidden');
            jQuery('nav.navbar.navbar-expand-lg.navbar-light.bg-light.sticky-top').css('margin-top', '0px');

        }
    });
</script>
<script>

    var addButton = function (context) {
        var ui = $.summernote.ui;

        // create button
        var button = ui.button({
            contents: '<i class="fa-solid fa-square-plus"/>',
            tooltip: 'addbutton',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.pasteHTML', '<button class="btn btn-secondary editor-buttons">Button</button>');
            }
        });

        return button.render(); // return button as jquery object
    }
</script>
{{ $slot }}
</body>
</html>
