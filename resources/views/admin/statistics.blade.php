@extends('layouts.admin.index')
@section('title','Statistics')
@section('content')

    <div class="mb-5">
        <h1 class="h3 mb-0 text-gray-800">Statistics</h1>
    </div>

    <div class="row">

        <div class="my-2 col-6  h-auto px-1">
            <div class="shadow rounded">
                {!! $thisMonthChart->container() !!}
            </div>
        </div>
        <div class="my-2 col-6  h-auto px-1">
            <div class="shadow rounded">
                {!! $revenueChart->container() !!}
            </div>
        </div>
        <div class="my-2 col-6  h-auto px-1">
            <div class="shadow rounded">
                {!! $yearsChart->container() !!}
            </div>
        </div>
        <div class="my-2 col-6  h-auto px-1">
            <div class="shadow rounded">
                {!! $monthsChart->container() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {!! $thisMonthChart->script() !!}
    {!! $yearsChart->script() !!}
    {!! $monthsChart->script() !!}
    {!! $revenueChart->script() !!}
    {{--    {!! $lastYearEarningChart->script() !!}--}}

@endsection
