@extends('layouts.admin.index')
@section('title','Dash Board')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">

        <!-- Today's Pending Requests  -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Orders Count(today)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{$pendingOrdersCountToday}}</div>
                        </div>
                        <div class="col-auto">

                            <i class="fa-solid fa-question  fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Today's Pending Requests  -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Canceled Orders Count(today)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{$canceledOrdersCountToday}}</div>
                        </div>
                        <div class="col-auto">

                            <i class="fa-solid fa-question  fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (today)
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                $ {{$todayOrdersEarning}} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (This month)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                $ {{$thisMonthOrdersEarning}} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (last month)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                $ {{$lastMonthOrdersEarning}} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4 ">
            <div
                class="card @if($lastMonthOrdersEarning&& (round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100)<0) border-left-danger @else border-left-success @endif  shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold  @if($lastMonthOrdersEarning &&(round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100)<0) text-danger @else  text-success  @endif text-uppercase mb-1">

                                Earning Rate (last month)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold @if($lastMonthOrdersEarning&&(round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100)<0) text-danger @else text-success @endif ">
                                @if($lastMonthOrdersEarning)
                                    % {{round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100}}
                                @else
                                    % 0
                                @endif

                                @if($lastMonthOrdersEarning&&(round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100)<0)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.8285 12.0259L16.2427 13.4402L12 17.6828L7.7574 13.4402L9.17161 12.0259L11 13.8544V6.31724H13V13.8544L14.8285 12.0259Z"
                                            fill="currentColor"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M19.7782 19.7782C15.4824 24.0739 8.51759 24.0739 4.22183 19.7782C-0.0739417 15.4824 -0.0739417 8.51759 4.22183 4.22183C8.51759 -0.0739419 15.4824 -0.0739419 19.7782 4.22183C24.0739 8.51759 24.0739 15.4824 19.7782 19.7782ZM18.364 18.364C14.8492 21.8787 9.15076 21.8787 5.63604 18.364C2.12132 14.8492 2.12132 9.15076 5.63604 5.63604C9.15076 2.12132 14.8492 2.12132 18.364 5.63604C21.8787 9.15076 21.8787 14.8492 18.364 18.364Z"
                                              fill="currentColor"/>
                                    </svg>
                                @elseif($lastMonthOrdersEarning&&(round((($thisMonthOrdersEarning/$lastMonthOrdersEarning)*100),2)-100)>0)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.8285 11.9481L16.2427 10.5339L12 6.29122L7.7574 10.5339L9.17161 11.9481L11 10.1196V17.6568H13V10.1196L14.8285 11.9481Z"
                                            fill="currentColor"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M19.7782 4.22183C15.4824 -0.0739415 8.51759 -0.0739422 4.22183 4.22183C-0.0739415 8.51759 -0.0739422 15.4824 4.22183 19.7782C8.51759 24.0739 15.4824 24.0739 19.7782 19.7782C24.0739 15.4824 24.0739 8.51759 19.7782 4.22183ZM18.364 5.63604C14.8492 2.12132 9.15076 2.12132 5.63604 5.63604C2.12132 9.15076 2.12132 14.8492 5.63604 18.364C9.15076 21.8787 14.8492 21.8787 18.364 18.364C21.8787 14.8492 21.8787 9.15076 18.364 5.63604Z"
                                              fill="currentColor"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">

        {{--        <!-- line Chart -->--}}
        {{--        <div class="col-xl-8 col-lg-7">--}}
        {{--            <div class="card shadow mb-4">--}}
        {{--                <!-- Card Header - Dropdown -->--}}
        {{--                <div--}}
        {{--                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
        {{--                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>--}}

        {{--                </div>--}}

        {{--                <!-- Card Body -->--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="chart-area">--}}
        {{--                        {!! $thisMonthOrdersEarningChart->container() !!}--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Pie Chart -->
{{--        <div class="col">--}}
{{--            <div class="card shadow mb-4">--}}
{{--                <!-- Card Header - Dropdown -->--}}
{{--                <div--}}
{{--                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Drivers today</h6>--}}
{{--                    <div class="dropdown no-arrow">--}}
{{--                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                        </a>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Card Body -->--}}
{{--                <div class="card-body">--}}
{{--                    <div class="chart-pie pt-4 pb-2">--}}


{{--                        {!! $topDriversChart->container() !!}--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 text-center small">--}}




{{--                        <span class="mr-2">--}}
{{--                            <i class="fas fa-circle text-primary"></i>  @if($DriversNames[0])--}}
{{--                                {{$DriversNames[0]}}--}}
{{--                            @endif--}}
{{--                        </span>--}}
{{--                        <span class="mr-2">--}}
{{--                            <i class="fas fa-circle text-success"></i>  @if( $DriversNames[1])--}}
{{--                                {{$DriversNames[1]}}--}}
{{--                            @endif--}}
{{--                        </span>--}}
{{--                        <span class="mr-2">--}}
{{--                            <i class="fas fa-circle text-info"></i>  @if($DriversNames[2])--}}
{{--                                {{$DriversNames[2]}}--}}
{{--                            @endif--}}
{{--                        </span>--}}
{{--                        <span class="mr-2">--}}
{{--                            <i class="fas fa-circle text-warning"></i> @if($DriversNames[3])--}}
{{--                                {{$DriversNames[3]}}--}}
{{--                            @endif--}}
{{--                        </span>--}}

{{--                        <span class="mr-2">--}}
{{--                            <i class="fas fa-circle text-secondary"></i>  @if($DriversNames[4])--}}
{{--                                {{$DriversNames[4]}}--}}
{{--                            @endif--}}
{{--                        </span>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
<?php

//   print_r( json_decode(file_get_contents('myfile.json'),true));
////

//
//    ;
//
//    if (\Carbon\Carbon::create($array[intval(count($array)-1)]['time'])->diffInMinutes(now())>=3 ||\Carbon\Carbon::create($array[intval(count($array)-1)]['time'])->diffInHours(now())>=1||\Carbon\Carbon::create($array[intval(count($array)-1)]['time'])->diffInDays(now())>=1 ){
//        $thisMonthOrdersEarning = \Illuminate\Support\Facades\DB::table('this_month_finished_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();
//        $lastMonthOrdersEarning = \App\Models\Order::selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->whereRaw('MONTH(delivery_time)=MONTH(curdate())-1')->first();
//        $todayOrdersEarning = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted', '1')->where('finished', '1')->first();
//        $pendingOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted', '0')->where('finished', '0')->where('canceled', '0')->first();
//        $canceledOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('canceled', '1')->first();
//
//        $list = array(
//
//            array(
//                $thisMonthOrdersEarning->price,
//                $thisMonthOrdersEarning->count,
//                $lastMonthOrdersEarning->price,
//                $todayOrdersEarning->price,
//                $todayOrdersEarning->count,
//                $pendingOrdersCountToday->count,
//                $pendingOrdersCountToday->price,
//                $canceledOrdersCountToday->count,
//                $canceledOrdersCountToday->price??0,
//                now()
//            )
//        );
//
//        $file = fopen("statistics.csv", "a+");
//
//        foreach ($list as $line) {
//            fputcsv($file, $line);
//        }
//
//        fclose($file);
//    }
//

?><!---->


@endsection
@section('scripts')


{{--    <script>--}}
{{--        --}}{{--$.ajax({--}}
{{--        --}}{{--    url: "{{url('admin/home')}}",--}}
{{--        --}}{{--    method: "post",--}}
{{--        --}}{{--    success:function (data){--}}
{{--        --}}{{--        console.log(data)--}}
{{--        --}}{{--    }--}}
{{--        --}}{{--});--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--        $.ajax({--}}
{{--            type:'post',--}}
{{--            url:'{{url('/admin/dashboard')}}',--}}

{{--            success:function(data) {--}}
{{--                console.log(data)--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

{{--    {!! $topDriversChart->script() !!}--}}
@endsection
