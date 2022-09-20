@extends('layouts.admin.index')
@section('title','Statistics')
@section('content')


    <div class="">
        <h1 class="h3 mb-0 text-gray-800">Statistics</h1>
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

{{--                        {!! $monthOrdersEarningChart->container() !!}--}}


                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    {!! $monthOrdersEarningChart->script() !!}
@endsection
