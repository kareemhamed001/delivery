@extends('layouts.admin.index')
@section('title','Statistics')
@section('content')

    <div class="mb-5">
        <h1 class="h3 mb-0 text-gray-800">Statistics</h1>
    </div>

    <div class="row text-capitalize h6">
        <div class="mb-3">
            <h1 class="h4 mb-0 text-gray-800">This month statistics</h1>
        </div>

        <div class="row">

            <div class="row">

                <div class="mb-3">
                    <h1 class="h4 mb-0 text-gray-800">earning statistics</h1>
                </div>

                <div class="col-xl-3 col-md-6 mb-4 ">
                    <div class="card border-left-primary shadow h-100 py-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col  mr-2 d-flex flex-column justify-content-between">
                                    <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                        Finished orders revenue
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-success">
                                        {{$thisMonthEarning}}

                                    </div>
                                    <div class="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">

                                                <div
                                                    class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                    @if($thisMonthTotalOrdersPrice)
                                                        {{round((($thisMonthEarning/$thisMonthTotalOrdersPrice)*100),2) }}
                                                    @else
                                                        0
                                                    @endif
                                                    %
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">

                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width:@if($thisMonthTotalOrdersPrice){{(($thisMonthEarning/$thisMonthTotalOrdersPrice)*100)}}@else 0 @endif%"
                                                         aria-valuenow="
                                              @if($thisMonthTotalOrdersPrice)
                                                {{(($thisMonthEarning/$thisMonthTotalOrdersPrice)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                         aria-valuemin="0"
                                                         aria-valuemax="100">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4 ">
                    <div class="card border-left-primary shadow h-100 py-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col  mr-2 d-flex flex-column justify-content-between">
                                    <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                        Loses(canceled orders)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-success">
                                        {{$thisMonthLoses}}

                                    </div>
                                    <div class="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">

                                                <div
                                                    class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                    @if($thisMonthTotalOrdersPrice)
                                                        {{round((($thisMonthLoses/$thisMonthTotalOrdersPrice)*100),2) }}
                                                    @else
                                                        0
                                                    @endif
                                                    %
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">

                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width:@if($thisMonthTotalOrdersPrice){{(($thisMonthLoses/$thisMonthTotalOrdersPrice)*100)}}@else 0 @endif%"
                                                         aria-valuenow="
                                              @if($thisMonthTotalOrdersPrice)
                                                {{(($thisMonthLoses/$thisMonthTotalOrdersPrice)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                         aria-valuemin="0"
                                                         aria-valuemax="100">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mb-3">
                <h1 class="h4 mb-0 text-gray-800">Orders statistics</h1>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Pending Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthpendingOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Running Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthrunningOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Finished Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthdeliveredOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All canceled Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthcanceledOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body row align-items-center">
                        <div class="row no-gutters align-items-center">
                            <div class="col h-100 mr-2 ">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthAllOrdersCount}}

                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="mb-3">
                <h1 class="h4 mb-0 text-gray-800">users statistics</h1>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Pending Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthpendingOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthpendingOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Running Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthrunningOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthrunningOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Finished Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthdeliveredOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthdeliveredOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col  mr-2 d-flex flex-column justify-content-between">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All canceled Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthcanceledOrdersCount}}

                                </div>
                                <div class="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                            <div
                                                class="h5 mb-0 mr-3 font-weight-bold text-success">
                                                @if($thisMonthAllOrdersCount)
                                                    {{round((($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100),2) }}
                                                @else
                                                    0
                                                @endif
                                                %
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width:@if($thisMonthAllOrdersCount){{(($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100)}}@else 0 @endif%"
                                                     aria-valuenow="
                                              @if($thisMonthAllOrdersCount)
                                                {{(($thisMonthcanceledOrdersCount/$thisMonthAllOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body row align-items-center">
                        <div class="row no-gutters align-items-center">
                            <div class="col h-100 mr-2 ">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                    All Orders Count
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-success">
                                    {{$thisMonthAllOrdersCount}}

                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">


        <div class="mb-3">
            <h1 class="h4 mb-0 text-gray-800">This year statistics</h1>
        </div>

        <!--ALL Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Pending Orders Count
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                {{$pendingOrdersCount}}

                            </div>
                        </div>
                        <div class="col-auto">


                            <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ALL Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Running Orders Count
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                {{$runningOrdersCount}}
                            </div>
                        </div>
                        <div class="col-auto">


                            <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ALL Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Finished Orders Count
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                {{$deliveredOrdersCount}}
                            </div>
                        </div>
                        <div class="col-auto">


                            <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ALL Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Canceled Orders Count
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                {{$canceledOrdersCount}}
                            </div>
                        </div>
                        <div class="col-auto">


                            <i class="fa-regular fa-bars-progress fa-2x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Today's Pending Requests/all pending requests  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> pending order
                                percentage
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">

                                    <div
                                        class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @if($allOrdersCount)
                                            {{round((($pendingOrdersCount/$allOrdersCount)*100),2) }}
                                        @else
                                            0
                                        @endif
                                        %
                                    </div>


                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width:@if($allOrdersCount){{(($pendingOrdersCount/$allOrdersCount)*100)}}@else 0 @endif%"
                                             aria-valuenow="
                                              @if($allOrdersCount)
                                                {{(($pendingOrdersCount/$allOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                             aria-valuemin="0"
                                             aria-valuemax="100">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Running Orders
                                percentage
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">

                                    <div
                                        class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @if($allOrdersCount)
                                            {{round((($runningOrdersCount/$allOrdersCount)*100),2) }}
                                        @else
                                            0
                                        @endif
                                        %
                                    </div>


                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width:@if($allOrdersCount){{(($runningOrdersCount/$allOrdersCount)*100)}}@else 0 @endif%"
                                             aria-valuenow="
                                              @if($allOrdersCount)
                                                {{(($runningOrdersCount/$allOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                             aria-valuemin="0"
                                             aria-valuemax="100">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Finished Orders
                                percentage
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">

                                    <div
                                        class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @if($allOrdersCount)
                                            {{round((($deliveredOrdersCount/$allOrdersCount)*100),2) }}
                                        @else
                                            0
                                        @endif
                                        %
                                    </div>


                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width:@if($allOrdersCount){{(($deliveredOrdersCount/$allOrdersCount)*100)}}@else 0 @endif%"
                                             aria-valuenow="
                                              @if($allOrdersCount)
                                                {{(($deliveredOrdersCount/$allOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                             aria-valuemin="0"
                                             aria-valuemax="100">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Canceled Orders
                                percentage
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">

                                    <div
                                        class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @if($allOrdersCount)
                                            {{round((($canceledOrdersCount/$allOrdersCount)*100),2) }}
                                        @else
                                            0
                                        @endif
                                        %
                                    </div>


                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width:@if($allOrdersCount){{(($canceledOrdersCount/$allOrdersCount)*100)}}@else 0 @endif%"
                                             aria-valuenow="
                                              @if($allOrdersCount)
                                                {{(($canceledOrdersCount/$allOrdersCount)*100)}}
                                              @else
                                              0
                                              @endif
                                              "
                                             aria-valuemin="0"
                                             aria-valuemax="100">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">

        <!-- line Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">This Year Earning</h6>

                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">

                        {!! $monthOrdersEarningChart->container() !!}


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Last Year Earning</h6>

                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">

                        {!! $lastYearEarningChart->container() !!}


                    </div>
                </div>
            </div>
        </div>


    </div>




@endsection

@section('scripts')
    {!! $monthOrdersEarningChart->script() !!}
    {!! $lastYearEarningChart->script() !!}

@endsection
