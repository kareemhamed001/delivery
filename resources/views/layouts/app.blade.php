<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">

</head>
<body>
    <div id="app">

        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{asset('assets/js/all.min.js')}}">

    </script>
</body>
</html>
