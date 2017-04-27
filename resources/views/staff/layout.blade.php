<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{url('css/app.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="/css/template/theme-default.css"/>
    <link rel="stylesheet" type="text/css" id="theme" href="/css/template/theme-blue.css"/>
    <style>
        .modal-backdrop.in{
            z-index: 1;
        }
        .modal-dialog{
            z-index: 10;
        }
        .modal-body {
            min-height: 290px;
        }
    </style>
    <!-- EOF CSS INCLUDE -->
    @yield("css")
    <script type="text/javascript" src="/js/template/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/template/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/template/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/template/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="/js/template/plugins/bootstrap/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/js/template/plugins.js"></script>
    <script type="text/javascript" src="/js/template/actions.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script type="text/javascript" src="/js/angular/core/BaseClass.js"></script>
    <script type="text/javascript" src="/js/angular/core/BaseFilter.js"></script>
    <script type="text/javascript" src="/js/angular/core/BaseService.js"></script>
    <script type="text/javascript" src="/js/angular/core/component.js"></script>
    <script type="text/javascript" src="/js/angular/core/BaseController.js"></script>
    <script type="text/javascript" src="/js/angular/core/underscore-min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield("script")
</head>
<body>
<div class="page-container" ng-app="myApp">
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
    @include('staff.sidebar')
    <!-- END X-NAVIGATION -->
    </div>
    <div class="page-content">
        <!-- START X-NAVIGATION VERTICAL -->
        @include('staff.header')
        <ul class="breadcrumb">
        </ul>
        <!-- END BREADCRUMB -->

        <div class="page-title">
            @yield('page_title')
        </div>

        <div class="page-content-wrap">

            @yield('page_content')

        </div>
        <audio id="audio-alert" src="/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="/audio/fail.mp3" preload="auto"></audio>
    </div>
</div>
@include('staff.logout')
</body>