<!DOCTYPE html>
<html lang="de" ng-app="customInterpolationApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Angular Material CSS now available via Google CDN; version 0.11.2 used here -->
    <link href="{{ asset('/css/angular-material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.circliful.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/includes.css') }}" rel="stylesheet">
    @yield('css_files')


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="nav">
    @include('includes.navbar')
</div>

<div class="sections">
    @yield('sections')
</div>

<footer>
    @include('includes.footer')
</footer>

@yield('modals')

<!-- Scripts -->
<script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('/js/jquery.smint.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.circliful.min.js') }}"></script>
<script src="{{ asset('/js/custom.jquery.js') }}"></script>
<!-- Angular Material Dependencies -->
<script src="{{ asset('/js/angular.min.js') }}"></script>
<script src="{{ asset('/js/angular-animate.min.js') }}"></script>
<script src="{{ asset('/js/angular-aria.min.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
<!-- Angular Material Javascript now available via Google CDN; version 0.11.2 used here -->
<script src="{{ asset('/js/angular-material.min.js') }}"></script>
@yield('js_files')
<script>
    $("document").ready(function(){
        @yield('jquery_files')
    });
</script>
</body>
</html>
