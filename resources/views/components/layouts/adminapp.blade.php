<!DOCTYPE html>
<html>
<head>
    @livewireStyles
    <title>Escaperoom Kootwijkerbroek - backend</title>

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossOrigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('storage/images/frontend/uploads/favicon.ico')}}">
    <script src="{{asset('/js/frontapp.js')}}"></script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="https://kit.fontawesome.com/a865bbd52d.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('/css/app.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/choices.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    {{--    multiple select--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="{{asset('/js/summernote-image-attributes.js')}}"></script>
    <script src="{{asset('/js/lang/NL.js')}}"></script>
</head>

<body>
<main class="admin-app">
    <header class="header" id="header">
        <div onclick="toggle_nav()" class="header_toggle" id="navbar-button"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <a href="/auth/account">
            <i class='bx bxs-user-detail'></i>
        </a>
    </header>

    <div class="l-navbar" id="backend-nav">
        <nav class="nav">
            <div>
                <a href="/" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">{{env('APP_NAME')}}</span> </a>
                <div class="nav_list">
                    <a href="/auth/dashboard" class="nav_link"> <span class="nav_name">Dashboard</span> </a>
                    <a href="/auth/pages" class="nav_link"> <span class="nav_name">Pagina's</span> </a>
                    <a href="/auth/menu" class="nav_link"> <span class="nav_name">Menu</span> </a>
                    <a href="/auth/configurator/colorCategories" class="nav_link"> <span class="nav_name">Configurator kleuren</span> </a>
                    <a href="/auth/impressions" class="nav_link"> <span class="nav_name">Impressies</span> </a>
                    <a href="/auth/magazine" class="nav_link"> <span class="nav_name">Magazine</span> </a>
                    <a href="/auth/footer" class="nav_link"> <span class="nav_name">Footer</span> </a>
                    <a href="/auth/reviews" class="nav_link"> <span class="nav_name">Reviews</span> </a>
                    <a href="/auth/settings" class="nav_link"> <span class="nav_name">Instellingen</span> </a>
                </div>
            </div>
            <li>
                <a class="nav_link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">Uitloggen</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
        </nav>
    </div>

    {{$slot}}
</main>
@filepondScripts
@livewireScripts
<script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
<script>




    jQuery('#multiple-select-field' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: true,
    } );





    function toggle_nav() {
        const element = document.getElementById("backend-nav");

        if (element.classList.contains('show')) {
            document.getElementById("navbar-button").style.marginLeft = "0";
            element.classList.remove('show')
        } else {
            element.classList.add('show');
            document.getElementById("navbar-button").style.marginLeft = "280px";
        }
    }
</script>
</body>
</html>
