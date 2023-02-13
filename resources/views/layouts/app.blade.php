<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard" />
    <meta name="author" content="3CoresDigitals" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Petrol Station Management System by 3CoresDigitals" />
    <meta property="og:title" content="Petrol Station Management System" />
    <meta property="og:description" content="Petrol Station Management System" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Petrol Station Management System</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{asset('main/images/favicon.png')}}" />
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">


    <style type="text/css">
        .form-reqs-error{
            color: red !important;
        }
    </style>
   
</head>

<body  class="vh-100">

        @yield("content")
     
</body>
    @yield('scripts')

</html>