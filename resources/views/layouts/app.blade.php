<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.scriptheader_old')

    <body class="text-left">
        @if(!empty(getAuthGaurd()))
        <!-- Begin page -->

       <div class="app-admin-wrap layout-sidebar-large">
        @if(Request::segment(1) != 'redeem')
            @include('layouts.header_old')
            @include('layouts.sidebar_old')
        @endif
            <div class="main-content">
                @yield('content')
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                {{getFormatedDate('','Y')}} © EM-Send.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div> -->
        @else
            @yield('content')
        @endif
        @include('layouts.footer')
    </body>

</html>
