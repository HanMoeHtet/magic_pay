<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d176439217.js" crossorigin="anonymous"></script>

    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-white shadow-sm position-sticky" style="top: 0; z-index: 2;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link d-flex">
                                    <div class="position-relative mr-4">
                                        <i class="fas fa-bell"></i>
                                        <span class="position-absolute notification-count nine-plus">
                                            <span>9+</span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Account') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-5">
            @yield('content')
        </main>

        @auth('web')
            <nav class="navbar navbar-expand navbar-light bg-white shadow-lg position-fixed w-100" style="bottom: 0">
                <div class="navbar-nav w-100 justify-content-around">
                    <a class="nav-item nav-link d-flex @if (Route::is('home')) active @endif" href="{{ route('home') }}">
                        <i class="fas fa-home" style="width: 24px;height: 24px; line-height: 24px;"></i>
                        <span class="d-none d-sm-inline ml-2">Home</span>
                    </a>
                    <a class="nav-item nav-link d-flex" href="{{ route('transactions.index') }}">
                        <i style="width: 24px;height: 24px; line-height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:svgjs="http://svgjs.com/svgjs" width="24" height="24" x="0" y="0"
                                viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512 512"
                                xml:space="preserve">
                                <g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path
                                                d="M443.077,379.077c-14.594,0-28.244-7.18-36.511-19.206l-21.682-31.538c-25.541,45.795-74.094,75.36-128.883,75.36    c-76.452,0-139.524-58.396-146.96-132.923h14.037c5.484,0,10.518-3.039,13.071-7.894c2.553-4.854,2.206-10.724-0.901-15.243    l-21.53-31.316l-32.624-47.454c-2.754-4.007-7.306-6.402-12.17-6.402c-0.608,0-1.211,0.037-1.807,0.11    c-0.596,0.073-1.183,0.183-1.76,0.326c-1.442,0.359-2.818,0.932-4.081,1.697c-1.768,1.07-3.318,2.515-4.523,4.268L2.599,247.632    c-3.107,4.519-3.454,10.39-0.901,15.243c2.553,4.853,7.587,7.895,13.072,7.895h15.24c3.514,54.931,26.587,106.091,65.859,145.364    c42.773,42.773,99.642,66.329,160.132,66.329s117.359-23.556,160.132-66.329c11.371-11.371,21.44-23.845,30.085-37.178    C445.176,379.029,444.13,379.077,443.077,379.077z"
                                                fill="currentColor" data-original="#000000" style="" class=""></path>
                                        </g>
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path
                                                d="M267.255,241.231h-22.505c-4.266,0-7.736-3.47-7.736-7.736v-11.253c0-4.265,3.47-7.735,7.736-7.735h22.505    c4.266,0,7.736,3.47,7.736,7.735c0,8.157,6.613,14.769,14.769,14.769c8.156,0,14.769-6.613,14.769-14.769    c0-19.366-14.848-35.325-33.759-37.103v-7.907c0-8.157-6.613-14.769-14.769-14.769c-8.157,0-14.769,6.613-14.769,14.769v7.907    c-18.91,1.778-33.759,17.737-33.759,37.103v11.253c0,20.554,16.721,37.275,37.275,37.275h22.505c4.266,0,7.736,3.47,7.736,7.736    v11.253c0,4.265-3.471,7.736-7.736,7.736h-22.505c-4.266,0-7.736-3.47-7.736-7.735c0-8.157-6.613-14.769-14.769-14.769    c-8.156,0-14.769,6.613-14.769,14.769c0,19.366,14.848,35.325,33.759,37.103v7.906c0,8.157,6.613,14.769,14.769,14.769    c8.157,0,14.769-6.613,14.769-14.769v-7.907c18.909-1.778,33.759-17.737,33.759-37.103v-11.253    C304.529,257.952,287.809,241.231,267.255,241.231z"
                                                fill="currentColor" data-original="#000000" style="" class=""></path>
                                        </g>
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path
                                                d="M510.303,249.125c-2.554-4.854-7.587-7.894-13.072-7.894h-15.24c-3.514-54.931-26.587-106.091-65.859-145.364    C373.36,53.095,316.49,29.539,256.001,29.539S138.641,53.095,95.869,95.868c-11.371,11.371-21.44,23.845-30.085,37.178    c1.041-0.074,2.087-0.122,3.14-0.122c14.595,0,28.244,7.18,36.511,19.206l21.682,31.538    c25.541-45.795,74.094-75.359,128.883-75.359c76.452,0,139.524,58.396,146.96,132.923h-14.037c-5.484,0-10.518,3.039-13.071,7.894    c-2.553,4.854-2.206,10.724,0.901,15.243l21.53,31.316l32.624,47.454c0.689,1.002,1.49,1.903,2.38,2.691    c2.67,2.364,6.143,3.711,9.791,3.711c4.863,0,9.416-2.395,12.171-6.402l19.554-28.443l34.599-50.326    C512.51,259.848,512.856,253.978,510.303,249.125z"
                                                fill="currentColor" data-original="#000000" style="" class=""></path>
                                        </g>
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <span class="d-none d-sm-inline ml-2">Transactions</span>
                    </a>
                    <a class="nav-item nav-link d-flex  @if (Route::is('profile')) active @endif " href=" {{ route('profile') }}">
                        <i class="fas fa-user-circle" style="width: 24px;height: 24px; line-height: 24px;"></i>
                        <span class="d-none d-sm-inline ml-2">Account</span>
                    </a>
                </div>
            </nav>
        @endauth
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session('message'))
            Toast.fire({
            icon: 'success',
            title: "{{ session('message') }}"
            })
        @endif
    </script>
    @yield('scripts')
</body>

</html>
