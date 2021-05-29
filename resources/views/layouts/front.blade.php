<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css">
    <link rel="stylesheet" href="//unpkg.com/tippy.js@6/themes/light.css">
    @yield('css')
</head>

<body class="bg-theme">
    @yield('content')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"> </script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <script src="//unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script>
        const handleScheduleClick = (info) => {
            window.location =
                `/appointments?date=${moment(info.event.start).format("YYYY-MM-DD")}&id=${info.event.extendedProps.id}`;
        }
    </script>
    <script src="//unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="//unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script src="//cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.5.0/main.global.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
   

    @yield('js')

</body>

</html>