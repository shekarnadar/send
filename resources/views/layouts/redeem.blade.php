<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     @include('layouts.scriptheader')
    <body class="text-left">
        @yield('content')
        @include('layouts.footer')
    </body>
</html>
