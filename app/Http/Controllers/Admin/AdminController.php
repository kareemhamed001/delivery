<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


    function statisticsView(){
        $monthsEarning = Order::select(
            DB::raw("(Month(delivery_time)) as month"),
            DB::raw("(sum(price)) as total_price")
        )
            ->whereRaw('YEAR(delivery_time)=YEAR(CURDATE())')
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->orderBy('month')
            ->groupBy('month')
            ->get();

        $monthsLabel = [];
        $monthsPrices = [];
        foreach ($monthsEarning as $month) {
            array_push($monthsLabel, $month['month']);
            array_push($monthsPrices, $month['total_price']);

        }
        $monthOrdersEarningChart = new ChartJs();

        $monthOrdersEarningChart->labels($monthsLabel);
        $monthOrdersEarningChart->dataset('monthly earning', 'line', $monthsPrices)->options([
            'color' => '#0000ff',
            'backgroundColor' => 'rgb(40,50,143,0.5)',
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
        ]);
        $monthOrdersEarningChart->minimalist(false);
        $monthOrdersEarningChart->displayLegend(false);
        $monthOrdersEarningChart->barWidth(10);
        $monthOrdersEarningChart->title('Monthly earning', 20, '#8e8e8e', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");



        return view('admin.statistics',compact('monthOrdersEarningChart'));
    }



    function index()
    {
        $monthsEarning = Order::select(
            DB::raw("(Month(delivery_time)) as month"),
            DB::raw("(sum(price)) as total_price")
        )
            ->whereRaw('YEAR(delivery_time)=YEAR(CURDATE())')
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->orderBy('month')
            ->groupBy('month')
            ->get();

        $monthsLabel = [];
        $monthsPrices = [];
        foreach ($monthsEarning as $month) {
            array_push($monthsLabel, $month['month']);
            array_push($monthsPrices, $month['total_price']);

        }
        $monthOrdersEarningChart = new ChartJs();

        $monthOrdersEarningChart->labels($monthsLabel);
        $monthOrdersEarningChart->dataset('monthly earning', 'line', $monthsPrices)->options([
            'color' => '#0000ff',
            'backgroundColor' => 'rgb(40,50,143,0.5)',
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
        ]);
        $monthOrdersEarningChart->minimalist(false);
        $monthOrdersEarningChart->displayLegend(false);
        $monthOrdersEarningChart->barWidth(10);
        $monthOrdersEarningChart->title('Monthly earning', 20, '#8e8e8e', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");


        $monthOrdersEarning = Order:: selectRaw("SUM(price) as price")
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE())')
            ->get();

        $lastMonthOrdersEarning = Order:: selectRaw("SUM(price) as price")
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE())-1')
            ->get();


        $todayOrdersEarning = Order:: selectRaw("SUM(price) as price")
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('Date(delivery_time) = CURDATE()')
            ->get();


        $pendingOrdersCountToday = Order::where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('Date(delivery_time) = CURDATE()')
            ->count();

        $pendingOrdersCountMonth = Order::where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE())')
            ->count();

        $allPendingOrdersCount = Order::where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->count();


        $topDriversToday = Order::selectRaw('accepted_by,COUNT(accepted_by) as count,SUM(price) as revenue')
            ->where('accepted', '1')
            ->where('finished', '1')
            ->where('accepted_by', '!=', 'null')
            ->whereRaw('DATE(delivery_time) = CURDATE()')
            ->orderBy('revenue', 'desc')
            ->groupBy('accepted_by')
            ->limit(5)
            ->get();
        $DriversNames = [
            0 => null,
            1 => null,
            2 => null,
            3 => null,
            4 => null,
        ];
        $DriversRevenue = [];
        $count = [];
        $i = 0;
        foreach ($topDriversToday as $topDriverToday) {
            $DriversNames[$i] = User::where('id', $topDriverToday['accepted_by'])->first()->name;
            array_push($DriversRevenue, $topDriverToday['revenue']);
            array_push($count, $topDriverToday['count']);
            $i++;
//            array_push($monthsPrices['total_price']);
        }

        $topDriversChart = new ChartJs();

        $topDriversChart->labels($DriversNames);
        $topDriversChart->dataset('monthly earning', 'pie', $DriversRevenue)->options([

            'backgroundColor' => ['rgb(13,110,253)', 'rgb(25,135,84,0.9)', 'rgb(13,202,240,0.8)', 'rgb(255,193,7,0.7)', 'rgb(108,117,125,0.6)'],
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
        ]);
        $topDriversChart->displayLegend(false);
        $topDriversChart->minimalist(true);


        return view('admin.dashBoard', compact('lastMonthOrdersEarning', 'pendingOrdersCountMonth', 'DriversNames', 'topDriversChart', 'topDriversToday', 'pendingOrdersCountToday', 'allPendingOrdersCount', 'todayOrdersEarning', 'monthOrdersEarning', 'monthsEarning', 'monthsLabel', 'monthsPrices', 'monthOrdersEarningChart'));
    }
}
