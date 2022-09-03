<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

<meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="/assets/js/toastr/toastr.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/assets/js/toastr/toastr.js"></script>
    <script src="/assets/js/common.js"></script>

    <!-- Template Main CSS File -->
    <link href="/assets/css/main.css" rel="stylesheet">

    @livewireStyles
    @powerGridStyles
</head>


<body>
    @if(Session::has("toaster_message"))
    {{-- {{ Session::forget("toaster_message") }} --}}
    <script>
        showToast('{{ Session::get("toaster_status") }}', 
                  '{{ ucwords(Session::get("toaster_title")) }}', 
                  '{{ Session::get("toaster_message") }}',
                  true)
    </script>
    {{-- {{ Session::forget("toaster_message") }} --}}
    @endif
    <div class="links-navbar text-white pb-0 pt-0">
        <div class="container h-100">
            <div class="h-100" id="navbarCollapse">
                <div class="d-flex justify-content-between">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-map-marker-alt"></i> Locations
                        </a>
                        <ul class="dropdown-menu link" aria-labelledby="navbarDropdown">
                            @foreach ($locations as $key => $location)
                                <li><a href="#" class="nav-item nav-link link">{{ $location->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <ul class="navbar-nav align-end">
                        <li><a href="#" class="nav-item nav-link active link">FAQ</a></li>
                        <li><a href="#" class="nav-item nav-link link">Contact</a></li>
                        <li><a href="#" class="nav-item nav-link link">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav id="category-navbar" class="navbar bg-white">
        <div class="container d-flex justify-content-between">
            <div>
                <div class="d-table-cell d-flex justify-content-start">
                    <a href="/laravela/public/" class="navbar-brand">{{ $settings["SETTINGS_WEBSITE_NAME"] }}</a>
                    <div class="logo-category-spacer"></div>
                </div>
            </div>
            <div class="d-flex mt-2 pb-2">
                <form method="POST" action="#">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                        <span class="input-group-text" id="search_bar"><i class="bi bi-search"></i></span>
                    </div>
                </form>
            </div>
        </div>

        <div class="container d-table d-flex col-12 pt-3 pb-3 mt-1" style="background: whitesmoke;">
            <a class="text-primary align-self-center item-name-font-weight" type="button"
                data-bs-toggle="collapse" data-bs-target="#category_drop_zone" aria-controls="category_drop_zone"
                aria-expanded="false">
                Categories
            </a>
            <div class="d-table-cell">
                {{-- <a href="{{ route("wishlist") }}"
                    class="text-primary item-name-font-weight">
                    <span>My Wishlist</span>
                    <i class="bi-heart fa-lg align-middle"></i>
                    <span class="top-0 translate-middle badge rounded-pill bg-info">{{ Cart::instance("wishlist")->content()->count() }}</span>                    
                </a>

                <a href="{{ route("shopcart") }}"
                    class="text-primary item-name-font-weight">
                    <span>My Cart</span>
                    <i class="bi-cart-check fa-lg align-middle"></i>
                    <span class="top-0 translate-middle badge rounded-pill bg-info">{{ Cart::instance("shopcart")->content()->count() }}</span>
                </a> --}}

                @if (Auth::check())
                    <a href="{{ route('dashboard') }}"
                        class="text-primary align-self-center item-name-font-weight">
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-primary align-self-center item-name-font-weight pe-3">Log in</a>
                    <a href="{{ route('register') }}" class="text-primary align-self-center item-name-font-weight">Register</a>
                @endif
            </div>
            <div class="navbar-collapse collapse" id="category_drop_zone"
                style="background: #f1f1f1; position: absolute; top: 100%; right: 0; left: 0; z-index: 1000; overflow: none;">
                <div class="container d-flex justify-content-center flex-wrap pb-3 pt-3 bg-secondary">
                    @foreach ($categories as $key => $category)
                    <a class="category-item d-table m-2"
                        href="/laravela/public/category/view/{{ $category->name }}"
                        style="background: {{ $category->color }};">
                        <div class="d-table-cell align-middle text-black bold">
                            <span><i class="icon-pr {{ $category->icon }}"></i>{{ $category->name
                                }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

    @livewireScripts
    @powerGridScripts
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        window.addEventListener('showAlert', event => {
            alert(event.detail.message);
        })

        $(document).ready(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 40) {
                    $('#category-navbar').addClass('fixed-top');
                    $('#header').css('top', '+=95px');
                } else {
                    $('#category-navbar').removeClass('fixed-top');
                    $('#header').css('top', '-=95px');
                }
            });
        });
    </script>
</body>

{{-- <body class="container antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="min-h-screen bg-gray-100">

            <div class="bg-white p-4 border border-gray-200 rounded">
                <livewire:power-grid-demo-table/>
            </div>

            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            {{-- <main>
                {{ $slot }}
            </main> --}}
        </div>
    </div>
    <!-- Scripts -->

</body>

</html>
