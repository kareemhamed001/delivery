<!DOCTYPE html>
<html >

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{csrf_token()}}" />

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/googleFonts.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

@livewireStyles
</head>

<body id="page-top" class="position-relative">



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.admin.sideBar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.admin.topBar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

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
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        {{--footer--}}
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
@stack('scripts')
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>


{{--    <!-- Core plugin JavaScript-->--}}
<script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="{{asset('assets/js/Chart.min.js')}}" charset="utf-8"></script>
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

@livewireScripts
@yield('scripts')
<script>
    {{--$.ajax({--}}
    {{--    url: "{{url('admin/home')}}",--}}
    {{--    method: "post",--}}
    {{--    success:function (data){--}}
    {{--        console.log(data)--}}
    {{--    }--}}
    {{--});--}}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type:'post',
        url:'{{url('/admin/dashboard')}}',

        success:function(data) {

            $('#pendingOrdersCountToday').html(data[0][5])
            $('#canceledOrdersCountToday').html(data[0][7])
            $('#todayOrdersEarning').html('$ '+data[0][3])
            $('#thisMonthOrdersEarning').html('$ '+data[0][0])
            $('#lastMonthOrdersEarning').html('$ '+data[0][2])
            $('#earningCard').removeClass('border-left-danger border-left-success')
            thisMonthEarning=data[0][0];
            lastMonthEarning=data[0][2];
            earningRate=((thisMonthEarning/lastMonthEarning)*100)-100
            if (earningRate>0){
                $('#earningRateHeader').removeClass('text-success  text-danger')
                $('#earningRate').removeClass('text-success  text-danger')
                $('#earningCard').addClass('border-left-success text-success ')
            }else {
                $('#earningRateHeader').removeClass('text-success  text-danger')
                $('#earningRate').removeClass('text-success  text-danger')
                $('#earningCard').addClass('border-left-danger text-danger')
            }
            $('#earningRate').html('% '+(earningRate).toFixed(2) )

        }
    });
    $.ajax({
        type:'post',
        url:'{{url('/admin/statistics')}}',

        success:function(data) {
            console.log(data)
        }
    });
</script>


{{--    <!-- Page level plugins -->--}}
{{--    <script src="{{asset('assets/js/Chart.min.js')}}"></script>--}}

{{--    <!-- Page level custom scripts -->--}}
{{--    <script src="{{asset('assets/js/chart-area-demo.js')}}"></script>--}}
{{--    <script src="{{asset('assets/js/chart-pie-demo.js')}}"></script>--}}

</body>

</html>
