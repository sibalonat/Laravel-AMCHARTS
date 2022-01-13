<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link id="favicon" rel="icon" href="{{ asset('faviconPng/icon0.png') }}" type="image" />

    {{-- fonts awesome --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @stack('scripts')
    <style>
        /* body,
        html {
            overflow-x: hidden !important;
        } */

        body {
            /* margin: 0; */
            width: 100vw;
            height: 100vh !important;
            overflow: hidden !important;
        }

    </style>
    <div id="app">
        <div class="container-fluid px-0 bg-transparent" style="width: 100vw; height: 100vh;">
            @yield('content')
        </div>
    </div>
    <script>
        function favicon() {
            var imageFav = '{{ URL::asset('/faviconPng/') }}';
            var favicon_images = [
                    imageFav + '/icon0.png',
                    imageFav + '/icon1.png',
                    imageFav + '/icon2.png',
                    imageFav + '/icon3.png',
                    imageFav + '/icon4.png',
                    imageFav + '/icon5.png',
                    imageFav + '/icon6.png',
                    imageFav + '/icon7.png',
                    imageFav + '/icon8.png',
                    imageFav + '/icon9.png',
                    imageFav + '/icon10.png',
                    imageFav + '/icon11.png',
                    imageFav + '/icon12.png',
                    imageFav + '/icon13.png',
                    imageFav + '/icon14.png',
                    imageFav + '/icon15.png',
                    imageFav + '/icon16.png',
                    imageFav + '/icon17.png',
                    imageFav + '/icon18.png',
                    imageFav + '/icon19.png',
                    imageFav + '/icon20.png',
                    imageFav + '/icon21.png',
                    imageFav + '/icon22.png',
                    imageFav + '/icon23.png',
                    imageFav + '/icon24.png',
                    imageFav + '/icon25.png',
                    imageFav + '/icon26.png',
                    imageFav + '/icon27.png',
                    imageFav + '/icon28.png',
                    imageFav + '/icon29.png',
                ],
                image_counter = 0;
            setInterval(function() {
                if (document.querySelector("link[rel='icon']") !== null)
                    document.querySelector("link[rel='icon']").remove();
                document.querySelector("head").insertAdjacentHTML('beforeend',
                    '<link rel="icon" href="' + favicon_images[image_counter] + '" type="image/png">');
                if (image_counter == 29) {
                    image_counter = 0
                } else
                    image_counter++;
            }, 200);
        }
        document.addEventListener("DOMContentLoaded", favicon());
    </script>
</body>

</html>
