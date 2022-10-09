<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;
use App\Charts\HighChartsJs;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Thread;

class AdminController extends Controller
{

    private $barChartOptions=[

        ' color' => 'rgb(13,110,253)',
//            'legend' => [
//                'layout' => 'vertical',
//                'align' => 'right',
//                'verticalAlign' => 'top',
//
////                'y'=>0,
////                'x'=>-470,
//                'floating' => false,
//                'borderWidth' => 1,
//                'shadow' => true
//            ],
        'plotOptions' => [
            'bar' => [
                'dataLabels' => [
                    'enabled' => true
                ]
            ]
        ],
        'yAxis' => [
            'min' => 0,
            'title' => [
                'text' => 'Prices (Dollar)',
                'align' => 'high'
            ],
            'labels' => [
                'overflow' => 'justify'
            ]
        ],
        'tooltip' => [
            'valueSuffix' => 'unit'
        ],

    ];

    function ordersView()
    {
        return view('admin.orders.orders');
    }

    function createOrderView()
    {
        return view('admin.orders.createOrder');
    }

    function runningOrdersView()
    {
        return view('admin.orders.running-orders');
    }

    function pendingOrdersView()
    {
        return view('admin.orders.pending-orders');
    }

    function canceledOrdersView()
    {
        return view('admin.orders.canceled-orders');
    }

    function deliveredOrdersView()
    {
        return view('admin.orders.delivered-orders');
    }

    function todayOrdersView()
    {

        return view('admin.orders.today-orders');
    }

    function usersView()
    {
        return view('admin.users.users');
    }

    function store(CreateOrderRequest $request)
    {
        try {

            $user = User::where('phone_number', $request->phone_number)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $request->userName,
                    'phone_number' => $request->phone_number,
                    'role_as' => 3,
                ]);
            }
            $value = $request['date'] . $request['time'];
            $date = Carbon::create($value);
            $order = Order::create([
                'user_id' => $user->id,
                'name' => $request['orderName'],
                'description' => $request['orderDescription'],
                'from_address' => $request['fromAddress'],
                'to_address' => $request['toAddress'],
                'price' => $request['price'],
                'delivery_time' => $date,
                'notes' => $request['notes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            toastr()->success('Done');
            return redirect()->back();
        } catch (Exception $e) {
            return $e;
        }
    }

    function statisticsView()

    {


        $query=Order::query();
        $yearsStatistics = $query->selectRaw(DB::raw('YEAR(delivery_time) as year , COUNT(*) as count ,SUM(price) as totalPrice '))->orderBy('year')->groupBy('year')->get();

        $years = [];
        $yearsOrdersCount = [];
        $yearsOrdersPrics = [];
        foreach ($yearsStatistics as $value) {
            array_push($years, $value->year);
            array_push($yearsOrdersCount, $value->count);
            array_push($yearsOrdersPrics, $value->totalPrice);
        }

        $yearsChart = new HighChartsJs();
        $yearsChart->title('Years statistics');
        $yearsChart->labels($years);
        $yearsChart->dataset('count of orders', 'bar', $yearsOrdersCount)
            ->options([
                'color' =>'rgb(13,110,253)',

            ]);
        $yearsChart->dataset('total prices of orders', 'bar', $yearsOrdersPrics)->options([
            'color' =>'rgb(25,135,84,0.9)',

        ]);
        $yearsChart->height(500);
        $yearsChart->options($this->barChartOptions);

        $currentYearStatistics = $query->selectRaw(DB::raw('Month(delivery_time) as month , COUNT(*) as count ,SUM(price) as totalPrice,avg(price) as avg '))->whereRaw('YEAR(delivery_time) = YEAR(curdate())')->orderBy('month')->groupBy('month')->get();

        $thisMonthAllOrdersCount = 0;
        $thisMonthAllOrdersAveragePrice = 0;
        $thisMonthTotalOrdersPrice = 0;

        $months = [];
        $monthsOrdersCount = [];
        $monthsOrdersPrics = [];
        foreach ($currentYearStatistics as $value) {
            array_push($months, $value->month);
            array_push($monthsOrdersCount, $value->count);
            array_push($monthsOrdersPrics, $value->totalPrice);
            if ($value->month = Carbon::now()->month) {
                $thisMonthAllOrdersCount = $value->count;
                $thisMonthAllOrdersAveragePrice = $value->avg;
                $thisMonthTotalOrdersPrice = $value->price;
            }
        }

        $monthsChart = new HighChartsJs();
        $monthsChart->title('months statistics');
        $monthsChart->labels($months);
        $monthsChart->dataset('count of orders', 'bar', $monthsOrdersCount)->options([
            'color' =>'rgb(13,110,253)',

        ]);
        $monthsChart->dataset('total prices of orders', 'bar', $monthsOrdersPrics)->options([
            'color' =>'rgb(25,135,84,0.9)',

        ]);;
        $monthsChart->height(500);
        $monthsChart->options($this->barChartOptions);

        $thisMonthPendingOrdersStatistics = DB::table('this_month_pending_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();
        $thisMonthRunningOrdersStatistics = DB::table('this_month_running_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();
        $thisMonthFinishedOrdersStatistics = DB::table('this_month_finished_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();
        $thisMonthCanceledOrdersStatistics = DB::table('this_month_canceled_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();

        $thisMonthpendingOrdersCount = $thisMonthPendingOrdersStatistics->count;
        $thisMonthpendingOrdersTotalPrice = $thisMonthPendingOrdersStatistics->price;
        $thisMonthpendingOrdersAvg = $thisMonthPendingOrdersStatistics->avg;

        $thisMonthrunningOrdersCount = $thisMonthRunningOrdersStatistics->count;
        $thisMonthrunningOrdersTotalPrice = $thisMonthRunningOrdersStatistics->price;
        $thisMonthrunningOrdersAvg = $thisMonthRunningOrdersStatistics->avg;

        $thisMonthdeliveredOrdersCount = $thisMonthFinishedOrdersStatistics->count;
        $thisMonthdeliveredOrdersTotalPrice = $thisMonthFinishedOrdersStatistics->price;
        $thisMonthdeliveredOrdersTotalAvg = $thisMonthFinishedOrdersStatistics->avg;

        $thisMonthcanceledOrdersCount = $thisMonthCanceledOrdersStatistics->count;
        $thisMonthcanceledOrdersTotalPrice = $thisMonthCanceledOrdersStatistics->price;
        $thisMonthcanceledOrdersAvg = $thisMonthCanceledOrdersStatistics->avg;




        $revenueChart = new ChartJs();
        $revenueChart->labels(['earning', 'loss']);
        $revenueChart->dataset('this month revenue', 'pie', [$thisMonthdeliveredOrdersTotalPrice, $thisMonthcanceledOrdersTotalPrice])->options([
            'backgroundColor' => ['rgb(25,135,84,0.9)', 'rgb(255,50,50,0.9)', 'rgb(13,202,240,0.8)', 'rgb(255,193,7,0.7)', 'rgb(108,117,125,0.6)'],
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
        ]);


        $thisMonthChart = new ChartJs();
        $thisMonthChart->title('This month statistics');
        $thisMonthChart->labels(['Pending Orders', 'Running Orders', 'Finished Orders', 'Canceled Orders']);
        $thisMonthChart->dataset('This Month Count', 'bar', [$thisMonthpendingOrdersCount, $thisMonthrunningOrdersCount, $thisMonthdeliveredOrdersCount, $thisMonthcanceledOrdersCount])->options([
            'backgroundColor' =>'rgb(13,110,253)',

        ]);
        $thisMonthChart->dataset('This Month Prices', 'bar', [$thisMonthpendingOrdersTotalPrice, $thisMonthrunningOrdersTotalPrice, $thisMonthdeliveredOrdersTotalPrice, $thisMonthcanceledOrdersTotalPrice])->options([
            'backgroundColor' =>'rgb(25,135,84,0.9)',

        ]);;;
//        $thisMonthChart->dataset('This Month Average prices', 'bar', [$thisMonthpendingOrdersAvg, $thisMonthrunningOrdersAvg, $thisMonthAllOrdersAveragePrice, $thisMonthcanceledOrdersAvg]);
        $thisMonthChart->height(400);

        return view('admin.statistics', compact(
            'revenueChart',
            'currentYearStatistics',
            'yearsChart',
            'thisMonthChart',
            'monthsChart'
        ));
    }


    function index()
    {
        $monthOrdersEarning =  DB::table('this_month_finished_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first()->price;
        $lastMonthOrdersEarning = $this->getMonthEarningFromOrdersTable(' - 1');

        $todayOrdersEarning = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted','1')->where('finished','1')->first();
        $pendingOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted','0')->where('finished','0')->where('canceled','0')->first();
        $canceledOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('canceled','1')->first();

        $topDriversToday = Order::with('driver')->selectRaw('accepted_by,COUNT(accepted_by) as count,SUM(price) as revenue')
            ->where('accepted', '1')
            ->where('finished', '1')
            ->where('accepted_by', '!=', 'null')
            ->whereRaw('DATE(delivery_time)= curdate()')
            ->orderBy('revenue', 'desc')
            ->groupBy('accepted_by')
            ->take(5)->get();

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
            $DriversNames[$i] = $topDriverToday->driver->name;
            array_push($DriversRevenue, $topDriverToday->revenue);
            array_push($count, $topDriverToday->count);
            $i++;
        }


        $topDriversChart = new ChartJs();
        $topDriversChart->labels($DriversNames);
        $topDriversChart->dataset('today earning', 'doughnut', $DriversRevenue)->options([
            'backgroundColor' => ['rgb(13,110,253)', 'rgb(25,135,84,0.9)', 'rgb(13,202,240,0.8)', 'rgb(255,193,7,0.7)', 'rgb(108,117,125,0.6)'],
            'tooltip' => [
                'show' => true
            ],
        ]);
        $topDriversChart->displayLegend(false);
        $topDriversChart->minimalist(true);

        return view('admin.dashBoard', compact('lastMonthOrdersEarning',  'canceledOrdersCountToday', 'DriversNames', 'topDriversChart', 'pendingOrdersCountToday', 'todayOrdersEarning', 'monthOrdersEarning'));
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
        where('finished', '1')->where('accepted','1')
            ->whereRaw('MONTH(delivery_time) = MONTH(CURDATE()) +' . ($numberOfMonths ? $numberOfMonths : '0'))
            ->sum('price');
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

