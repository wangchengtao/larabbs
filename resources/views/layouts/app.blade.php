<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div class="{{ route_class() }}-page" id="app">

            @include('layouts._header')

            <div class="container">

                @yield('content')

            </div>

            @include('layouts._footer')
        </div>

        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    </body>
</html>