<!DOCTYPE html>
<html lang="en">

<head>
    @stack('before-style')
    @include('backend_mazer.layouts.head')
    @stack('after-style')
</head>

<body>
    <div id="app">
        @include('backend_mazer.layouts.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')


            @include('backend_mazer.layouts.footer')
        </div>
    </div>

    @stack('before-js')
    @include('backend_mazer.layouts.js')
    @stack('after-js')

</body>

</html>
