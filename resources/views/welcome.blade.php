<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link href="{{ asset('dashboard_css/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('dashboard_css/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <title>ProActive</title>
    <!-- Vendor CSS Files -->
    <link href="./dashboard_css/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_css/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dashboard_css/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('common.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('groupChat.css')}}">

    <link href="{{ asset('') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>

<body class="animsition">
<div class="page-wrapper"></div>

    <script src="{{ asset('dashboard_css/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dashboard_css/assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('dashboard_css/assets/js/main.js') }}"></script>
    <!-- <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script> -->

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>