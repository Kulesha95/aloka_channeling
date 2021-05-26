<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.css') }}">
    @yield('css')
    <style>
        :root{
            font-size: 20px !important;
        }
    </style>
</head>

<body class="bg-theme">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <h5 class="text-center font-weight-bold mx-auto"><u>@yield('title')</u></h5>
        </div>
        @yield('content')
    </div>
</body>

</html>