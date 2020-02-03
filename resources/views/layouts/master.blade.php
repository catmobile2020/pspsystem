
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth_id" content="{{ auth()->id() }}">
    <title>PSP System | @yield('title')</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('assets/admin/images/favicon.ico')}}' />
    <!-- /site favicon -->

    @include('layouts.assets.css')

</head>
<body>

<!-- Page container -->
<div class="page-container">

   @include('layouts.sidebar')

    <!-- Main container -->
    <div class="main-container" id="app">

        @include('layouts.header')
        @if (auth('marketing')->check())
                <div class="row" style="background-color: #f5f5f5; padding: 12px 50px">
                    <img class="center-block" src="{{auth('marketing')->user()->company->photo}}" style="height: 115px">
                </div>
        @endif

        <div class="modal fade" id="showModalContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="insertModalData">

                </div>
            </div>
        </div>
        <!-- Main content -->
        @yield('content')
        <!-- /main content -->

    </div>
    <!-- /main container -->

</div>
<!-- /page container -->

@include('layouts.assets.js')

</body>
</html>
