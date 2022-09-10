<!doctype html>
<html @if(LaravelLocalization::setLocale()=='ar')dir="rtl" @endif lang="LaravelLocalization::setLocale()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{asset('assets/images/sonic-png-20635 (1).png')}}" type="image/x-icon">

    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
{{--    <link href="E:\wamp64\www\delivery\node_modules\bootstrap\dist\css\bootstrap.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Sonic</title>
    @livewireStyles
</head>
<body class="bg-white vw-100  ">

@include('layouts.front.navbar')
<div id="done-toast" class="toast  fade position-fixed top-50 start-50 translate-middle @if(session('error')) bg-danger @elseif(session('done')) bg-success @endif " style="z-index: 1">
    <div class="toast-header">
        <strong class="me-auto "><i class=" @if(session('error'))fa-solid fa-circle-exclamation @elseif(session('done'))fa-regular fa-circle-check @endif  "></i>@if(session('error')) Sorry! @elseif(session('done')) Concratulations! @endif </strong>
        <small>just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body text-white">
        @if(session('done'))
            {{session('done')}}
        @endif
        @if(session('error'))
            {{session('error')}}
        @endif
    </div>
</div>
@yield('content')
@include('layouts.front.footer')

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@if(session('done')||session('error'))
    <script>
        $(document).ready(function () {
            $("#done-toast").toast({
                delay: 4000
            });
            $('#done-toast').toast('show');
            setInterval(function () {
                $('#done-toast').toast('hide');
            }, 4000);
        });
    </script>
@endif

<script>
    var activePage =String( window.location.pathname);
    activePage=activePage.split('/')
    const navLinks = document.querySelectorAll('ul li a.nav-link').forEach(link => {
        if (link.href.split('/').slice(-1)==(`${activePage[2]}`)|| link.href.split('/').slice(-2)==(`${activePage[2]}`) ) {
            link.classList.add('active');
        }
    });
</script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        offset:100,
        duration:800
    });
</script>

@livewireScripts
@stack('scripts')
@yield('scripts')


</body>
</html>
