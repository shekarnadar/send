<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/themes/lite-purple.min.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/plugins/toastr.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/datatables.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- toaster css-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="{{ url('assets/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('assets/js/common-bundle-script.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        
    <!-- dashboard css-->
    <!--         <link href="{{ url('assets/css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet"/>
 -->

    <script src="{{ url('assets/js/script.js') }}"></script>
    <!--         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>           -->
    {{-- <script src="{{ url('assets/js/plugins/toastr.min.js') }}"></script> --}}
    <!-- toaster script-->
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <!-- dashboard js-->

    <script src="{{ url('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts/script.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/echarts.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts/dashboard.v1.script.min.js') }}"></script>

    <script src="{{ url('assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts/datatables.script.min.js') }}"></script>

    <script src="{{ url('assets/js/plugins/tagging.min.js') }}"></script>
   
</head>
