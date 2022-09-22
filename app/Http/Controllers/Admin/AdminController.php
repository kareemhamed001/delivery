<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;

use App\Http\Controllers\Controller;
use App\Models\Order;

use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;


class AdminController extends Controller
{

    public $thisMonthpendingOrdersCount = 0;
    public $thisMonthrunningOrdersCount = 0;
    public $thisMonthcanceledOrdersCount = 0;
    public $thisMonthdeliveredOrdersCount = 0;
    public $thisMonthAllOrdersCount = 0;
    public $pendingOrdersCount = 0;
    public $runningOrdersCount = 0;
    public $canceledOrdersCount = 0;
    public $deliveredOrdersCount = 0;
    public $allOrdersCount = 0;


    function ordersView(){
        return view('admin.orders');
    }


    function statisticsView()
    {

        $currentYearEarning = $this->getYearEarningFromOrdersTable();
        $monthOrdersEarningChart = $this->getAnnualChart($currentYearEarning, 'This Year Earning', 'rgb(60,120,180,0.5)');

        $lastYearEarning = $this->getYearEarningFromOrdersTable('-1');
        $lastYearEarningChart = $this->getAnnualChart($lastYearEarning, 'Last Year Earning', 'rgb(60,120,180,0.5)');


        Order::whereRaw('MONTH(delivery_time)=MONTH(CURDATE())')->orderBy('delivery_time', 'desc')->chunk(140000, function ($orders) {

            $this->thisMonthpendingOrdersCount += $orders->where('accepted', '0')->where('finished', '0')->where('canceled', '0')->count();
            $this->thisMonthrunningOrdersCount += $orders->where('accepted', '1')->where('finished', '0')->where('canceled', '0')->count();
            $this->thisMonthcanceledOrdersCount += $orders->where('canceled', '1')->count();
            $this->thisMonthdeliveredOrdersCount += $orders->where('accepted', '1')->where('finished', '1')->where('canceled', '0')->count();
            $this->thisMonthAllOrdersCount += $orders->count();
        });
        Order::whereRaw('YEAR(delivery_time)=YEAR(CURDATE())')->orderBy('delivery_time', 'desc')->chunk(140000, function ($orders) {

            $this->deliveredOrdersCount += $orders->where('accepted', '1')->where('finished', '1')->where('canceled', '0')->count();
            $this->pendingOrdersCount += $orders->where('accepted', '0')->where('finished', '0')->where('canceled', '0')->count();
            $this->runningOrdersCount += $orders->where('accepted', '1')->where('finished', '0')->where('canceled', '0')->count();
            $this->canceledOrdersCount += $orders->where('canceled', '1')->count();
            $this->allOrdersCount += $orders->count();


        });

        $pendingOrdersCount = $this->pendingOrdersCount;
        $runningOrdersCount = $this->runningOrdersCount;
        $canceledOrdersCount = $this->canceledOrdersCount;
        $deliveredOrdersCount = $this->deliveredOrdersCount;
        $allOrdersCount = $this->allOrdersCount;
        $thisMonthpendingOrdersCount = $this->thisMonthpendingOrdersCount;
        $thisMonthrunningOrdersCount = $this->thisMonthrunningOrdersCount;
        $thisMonthcanceledOrdersCount = $this->thisMonthcanceledOrdersCount;
        $thisMonthdeliveredOrdersCount = $this->thisMonthdeliveredOrdersCount;
        $thisMonthAllOrdersCount = $this->thisMonthAllOrdersCount;


        $thisMonthEarning = $this->getMonthEarningFromOrdersTable();
        $thisMonthLoses = $this->getMonthLossesFromOrdersTable();
        $thisMonthTotalOrdersPrice = Order:: selectRaw("SUM(price) as price")
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE())')
            ->cursor()->first()['price'];


        return view('admin.statistics', compact(

            'allOrdersCount',
            'monthOrdersEarningChart',
            'lastYearEarningChart',
            'runningOrdersCount',
            'pendingOrdersCount',
            'canceledOrdersCount',
            'deliveredOrdersCount',
            'thisMonthAllOrdersCount',
            'thisMonthpendingOrdersCount',
            'thisMonthrunningOrdersCount',
            'thisMonthcanceledOrdersCount',
            'thisMonthdeliveredOrdersCount',
            'thisMonthEarning',
            'thisMonthLoses',
            'thisMonthTotalOrdersPrice'
        ));
    }


    function index()
    {
        $currentYearEarning = $this->getYearEarningFromOrdersTable();
        $monthOrdersEarningChart = $this->getAnnualChart($currentYearEarning, 'This year earning', 'rgb(60,120,180,0.5)');

        $monthOrdersEarning = $this->getMonthEarningFromOrdersTable();

        $lastMonthOrdersEarning = $this->getMonthEarningFromOrdersTable(' - 1');

        $todayOrdersEarning = Order:: selectRaw("SUM(price) as price")
            ->where('accepted', '0')
            ->where('finished', '0')
            ->where('canceled', '0')
            ->whereRaw('Date(delivery_time) = CURDATE()')
            ->get();


        $pendingOrdersCountToday =
            Order::where('accepted', '0')
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


        return view('admin.dashBoard', compact('lastMonthOrdersEarning', 'pendingOrdersCountMonth', 'DriversNames', 'topDriversChart', 'topDriversToday', 'pendingOrdersCountToday', 'allPendingOrdersCount', 'todayOrdersEarning', 'monthOrdersEarning', 'currentYearEarning', 'monthOrdersEarningChart'));
    }


    function getYearEarningFromOrdersTable(string $numberOfYears = '0', $yAxis = 'sum(price)', $monthsXAxes = 'delivery_time')
    {
        $currentYearEarning = Order::select(
            DB::raw("(Month(" . $monthsXAxes . ")) as month"),
            DB::raw("(" . $yAxis . ") as total")
        )
            ->whereRaw('YEAR(delivery_time)= YEAR(CURDATE()) +' . ($numberOfYears ? $numberOfYears : '0'))
            ->where('finished', '1')
            ->orderBy('month')
            ->groupBy('month')
            ->cursor();

        if ($currentYearEarning) {
            return $currentYearEarning;
        }
        return null;
    }

    function getAnnualChart($yearEarning, $title = 'Monthly Earning', $color = 'rgb(40,50,143,0.5)')
    {
        $xLabel = [];
        $yLabel = [];
        foreach ($yearEarning as $month) {
            array_push($yLabel, $month['total']);
            array_push($xLabel, $month['month']);
        }

        $chart = new ChartJs();

        $chart->labels($xLabel);
        $chart->dataset($title, 'line', $yLabel)->options([
            'color' => '#0000ff',
            'backgroundColor' => $color,
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
        ]);
        $chart->minimalist(false);
        $chart->displayLegend(false);
        $chart->barWidth(10);
        $chart->title($title, 20, '#8e8e8e', 500);

        return $chart;
    }

    function getMonthEarningFromOrdersTable(string $numberOfMonths = '0')
    {
        $mothEarning = Order::
        where('finished', '1')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE()) +' . ($numberOfMonths ? $numberOfMonths : '0'))
            ->cursor()->sum('price');
        return $mothEarning;
    }

    function getMonthLossesFromOrdersTable(string $numberOfMonths = '0')
    {
        $monthLoses = Order::where('canceled', '1')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE())+' . ($numberOfMonths ? $numberOfMonths : '0'))
            ->cursor()->sum('price');
        return $monthLoses;
    }


}
