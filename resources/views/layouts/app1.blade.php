<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     @if(!empty(getAuthGaurd()))
            @include('layouts.scriptheader')
     @else
             @include('layouts.signup_header')
     @endif
    <body>
        @if(!empty(getAuthGaurd()))
        <!-- Begin page -->

        @if(Request::segment(1) != 'redeem')
            @include('layouts.header')
            @include('layouts.sidebar')
        @endif
            <main id="main" class="main">
                @yield('content')
            </main>
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i
      class="bi bi-arrow-up-short"></i></a> --&gt;

        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div> -->
        @else
            @yield('content')
        @endif
        @include('layouts.footer')
    </body>

</html>
