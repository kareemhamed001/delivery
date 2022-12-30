<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;
use App\Charts\HighChartsJs;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Models\Motorcycle;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Thread;
use function Clue\StreamFilter\fun;

class AdminController extends Controller
{

    private $barChartOptions = [

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

    function showOrder(Order $order)
    {

        try {

            return view('admin.orders.show', compact('order'));

        } catch (Exception $e) {

            return $e;
        }
    }

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

    function addUserView()
    {
        return view('admin.users.add-user');
    }

    function storeUser(Request $request)
    {

        $request->validate([

            'user_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'starts_with:01', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'int', 'max:3', 'max_digits:1'],

        ]);

        if ($request->user_type == 1) {
            $request->validate([
                'national_id' => ['required', 'numeric', 'max_digits:14', 'min_digits:14'],
                'moto_number' => ['required', 'numeric', 'max_digits:4', 'min_digits:4'],
                'moto_model' => ['required', 'numeric', 'date_format:Y'],
                'year_of_getting_licence' => ['required', 'numeric', 'date_format:Y'],
                'number_of_years_of_the_license' => ['required', 'numeric', 'max:3', 'min:1'],
            ]);
        }
        try {

            $user = new User();
            $user->name = $request->user_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->role_as = $request->user_type;
            $user->remember_token = Str::random(10);
            if ($request->user_type == 1) {
                $user->national_id = Str::random(10);
            }

//        $user=User::create([
//
//            'name'=>$request->user_name,
//            'email'=>$request->email,
//            'phone_number'=>$request->phone_number,
//            'password'=>Hash::make($request->password),
//            'role_as'=>$request->user_type,
//            'remember_token'=>Str::random(10),
//
//        ]);
            $user->save();

            if ($request->user_type == 1) {
                Motorcycle::create([
                    'driver_id'=>$user->id,
                    'number'=>$request->moto_number,
                    'model'=>$request->moto_model,
                    'licence_year'=>$request->year_of_getting_licence,
                    'licence_years_count'=>$request->number_of_years_of_the_license,
                    'box'=>$request->have_box?'1':'0',
                ]);
            }
            toastr()->success('Email Created Successfully');
        return redirect()->back()->with('Email Created Successfully');
        }catch (Exception $e){
            toastr()->error('Try Again');
            return redirect()->back()->with('Try Again');
        }
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

    function getStatisticsPageResults()
    {

        $yearsStatistics = Order::selectRaw(DB::raw('YEAR(delivery_time) as year , COUNT(*) as count ,SUM(price) as totalPrice '))->orderBy('year')->groupBy('year')->get();
        $currentYearStatistics = Order::selectRaw(DB::raw('Month(delivery_time) as month , COUNT(*) as count ,SUM(price) as totalPrice,avg(price) as avg '))->whereRaw('YEAR(delivery_time) = YEAR(curdate())')->orderBy('month')->groupBy('month')->get();
        $thisMonthPendingOrdersStatistics = DB::table('this_month_pending_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->get();
        $thisMonthRunningOrdersStatistics = DB::table('this_month_running_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->get();
        $thisMonthFinishedOrdersStatistics = DB::table('this_month_finished_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->get();
        $thisMonthCanceledOrdersStatistics = DB::table('this_month_canceled_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->get();

        $list = array(


            array(

                $yearsStatistics,
                $currentYearStatistics,
                $thisMonthPendingOrdersStatistics,
                $thisMonthRunningOrdersStatistics,
                $thisMonthFinishedOrdersStatistics,
                $thisMonthCanceledOrdersStatistics,
                now()
            )
        );

        $file = fopen("statisticsPage.csv", "a+");

        foreach ($list as $line) {
            fputcsv($file, $line);
        }

        fclose($file);
        return response('done', 200);
    }

    function statisticsView()

    {


        $rows = [];
        $handle = fopen('statisticsPage.csv', "r");
        while (($row = fgetcsv($handle)) !== false) {
            $rows[] = $row;
        }
        fclose($handle);

        $headers = array_shift($rows);

        $array = [];
        foreach ($rows as $row) {
            $array[] = array_combine($headers, $row);
        }
        $yearsStatistics = json_decode($array[count($array) - 1]['yearsStatistics']);


        $query = Order::query();
//        $yearsStatistics = $query->selectRaw(DB::raw('YEAR(delivery_time) as year , COUNT(*) as count ,SUM(price) as totalPrice '))->orderBy('year')->groupBy('year')->get();


        $years = [];
        $yearsOrdersCount = [];
        $yearsOrdersPrics = [];
        $yearsChart = new HighChartsJs();
//        $query->selectRaw(DB::raw('YEAR(delivery_time) as year , COUNT(*) as count ,SUM(price) as totalPrice '))->orderBy('year')->groupBy('year')->chunk(100000,function ($ordres)use($yearsChart){
////             $yearsStatistics =$ordres;
//            foreach ($ordres as $value) {
//                $years[] = $value->year;
//                $yearsOrdersCount[] = $value->count;
//                $yearsOrdersPrics[] = $value->totalPrice;
//            }
//
//
//            $yearsChart->title('Years statistics');
//            $yearsChart->labels($years);
//            $yearsChart->dataset('count of orders', 'bar', $yearsOrdersCount)
//                ->options([
//                    'color' =>'rgb(13,110,253)',
//
//                ]);
//            $yearsChart->dataset('total prices of orders', 'bar', $yearsOrdersPrics)->options([
//                'color' =>'rgb(25,135,84,0.9)',
//
//            ]);
//            $yearsChart->height(500);
//            $yearsChart->options($this->barChartOptions);
//
//        });


        foreach ($yearsStatistics as $value) {
            array_push($years, $value->year);
            array_push($yearsOrdersCount, $value->count);
            array_push($yearsOrdersPrics, $value->totalPrice);
        }

        $yearsChart = new HighChartsJs();
        $yearsChart->title('Years statistics');
        $yearsChart->labels($years);
        $yearsChart->dataset('count of orders', 'column', $yearsOrdersCount)
            ->options([
                'color' => 'rgb(13,110,253)',
                'tooltip' => [
                    'valueSuffix' => ' unit'
                ],

            ]);
        $yearsChart->dataset('total prices of orders', 'column', $yearsOrdersPrics)->options([
            'color' => 'rgb(25,135,84,0.9)',
            'tooltip' => [
                'valueSuffix' => ' Dollar'
            ],

        ]);
        $yearsChart->height(500);
        $yearsChart->options($this->barChartOptions);

        $currentYearStatistics = json_decode($array[count($array) - 1]['currentYearStatistics']);

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
                $thisMonthTotalOrdersPrice = $value->totalPrice;
            }
        }

        $monthsChart = new HighChartsJs();
        $monthsChart->title('months statistics');
        $monthsChart->labels($months);
        $monthsChart->dataset('count of orders', 'bar', $monthsOrdersCount)->options([
            'color' => 'rgb(13,110,253)',

        ]);
        $monthsChart->dataset('total prices of orders', 'bar', $monthsOrdersPrics)->options([
            'color' => 'rgb(25,135,84,0.9)',

        ]);;
        $monthsChart->height(500);
        $monthsChart->options($this->barChartOptions);

        $thisMonthPendingOrdersStatistics = json_decode($array[count($array) - 1]['thisMonthPendingOrdersStatistics']);
        $thisMonthRunningOrdersStatistics = json_decode($array[count($array) - 1]['thisMonthRunningOrdersStatistics']);
        $thisMonthFinishedOrdersStatistics = json_decode($array[count($array) - 1]['thisMonthFinishedOrdersStatistics']);
        $thisMonthCanceledOrdersStatistics = json_decode($array[count($array) - 1]['thisMonthCanceledOrdersStatistics']);


        $thisMonthpendingOrdersCount = $thisMonthPendingOrdersStatistics[0]->count;
        $thisMonthpendingOrdersTotalPrice = $thisMonthPendingOrdersStatistics[0]->price;
        $thisMonthpendingOrdersAvg = $thisMonthPendingOrdersStatistics[0]->avg;

        $thisMonthrunningOrdersCount = $thisMonthRunningOrdersStatistics[0]->count;
        $thisMonthrunningOrdersTotalPrice = $thisMonthRunningOrdersStatistics[0]->price;
        $thisMonthrunningOrdersAvg = $thisMonthRunningOrdersStatistics[0]->avg;

        $thisMonthdeliveredOrdersCount = $thisMonthFinishedOrdersStatistics[0]->count;
        $thisMonthdeliveredOrdersTotalPrice = $thisMonthFinishedOrdersStatistics[0]->price;
        $thisMonthdeliveredOrdersTotalAvg = $thisMonthFinishedOrdersStatistics[0]->avg;

        $thisMonthcanceledOrdersCount = $thisMonthCanceledOrdersStatistics[0]->count;
        $thisMonthcanceledOrdersTotalPrice = $thisMonthCanceledOrdersStatistics[0]->price;
        $thisMonthcanceledOrdersAvg = $thisMonthCanceledOrdersStatistics[0]->avg;


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
            'backgroundColor' => 'rgb(13,110,253)',

        ]);
        $thisMonthChart->dataset('This Month Prices', 'bar', [$thisMonthpendingOrdersTotalPrice, $thisMonthrunningOrdersTotalPrice, $thisMonthdeliveredOrdersTotalPrice, $thisMonthcanceledOrdersTotalPrice])->options([
            'backgroundColor' => 'rgb(25,135,84,0.9)',

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

    function setInterval($func, $seconds)
    {
        $seconds = (int)$seconds;
        $_func = $func;
        while (true) {
            $_func;
            sleep($seconds);
        }
    }

    public function getDashboardStatisticsResultsReady()
    {


        $rows = [];
        $handle = fopen('statistics.csv', "r");
        while (($row = fgetcsv($handle)) !== false) {
            $rows[] = $row;
        }
        fclose($handle);
// Remove the first one that contains headers
        $headers = array_shift($rows);
// Combine the headers with each following row
        $array = [];
        foreach ($rows as $row) {
            $array[] = array_combine($headers, $row);
        }

        if (\Carbon\Carbon::create($array[intval(count($array) - 1)]['time'])->diffInMinutes(now()) >= 0 || \Carbon\Carbon::create($array[intval(count($array) - 1)]['time'])->diffInHours(now()) >= 1 || \Carbon\Carbon::create($array[intval(count($array) - 1)]['time'])->diffInDays(now()) >= 1) {
            $thisMonthOrdersEarning = \Illuminate\Support\Facades\DB::table('this_month_finished_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->first();
            $lastMonthOrdersEarning = \App\Models\Order::selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->whereRaw('MONTH(delivery_time)=MONTH(curdate())-1')->first();
            $todayOrdersEarning = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted', '1')->where('finished', '1')->first();
            $pendingOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('accepted', '0')->where('finished', '0')->where('canceled', '0')->first();
            $canceledOrdersCountToday = DB::table('today_orders_view')->selectRaw(DB::raw('COUNT(*) as count ,SUM(price) as price,AVG(price) as avg'))->where('canceled', '1')->first();

            $list = array(

                array(
                    $thisMonthOrdersEarning->price,
                    $thisMonthOrdersEarning->count,
                    $lastMonthOrdersEarning->price,
                    $todayOrdersEarning->price,
                    $todayOrdersEarning->count,
                    $pendingOrdersCountToday->count,
                    $pendingOrdersCountToday->price,
                    $canceledOrdersCountToday->count,
                    $canceledOrdersCountToday->price ?? 0,
                    now()
                )
            );

            $file = fopen("statistics.csv", "a+");

            foreach ($list as $line) {
                fputcsv($file, $line);
            }

            fclose($file);
        }

        return response($list, 200);
    }


    function index()
    {

        // Parse the rows
        $rows = [];
        $handle = fopen('statistics.csv', "r");
        while (($row = fgetcsv($handle)) !== false) {
            $rows[] = $row;
        }
        fclose($handle);
// Remove the first one that contains headers


        $headers = array_shift($rows);
// Combine the headers with each following row
        $array = [];

        foreach ($rows as $row) {
            $array[] = array_combine($headers, $row);
        }

        $thisMonthOrdersEarning = floatval($array[intval(count($array) - 1)]['thisMonthOrdersEarning']);
        $thisMonthOrdersCount = floatval($array[intval(count($array) - 1)]['thisMonthOrdersCount']);
        $lastMonthOrdersEarning = floatval($array[intval(count($array) - 1)]['lastMonthOrdersEarning']);
        $todayOrdersEarning = floatval($array[intval(count($array) - 1)]['todayOrdersEarning']);
        $todayOrdersCount = floatval($array[intval(count($array) - 1)]['todayOrdersCount']);
        $pendingOrdersCountToday = floatval($array[intval(count($array) - 1)]['pendingOrdersCountToday']);
        $pendingOrdersPriceToday = floatval($array[intval(count($array) - 1)]['pendingOrdersPriceToday']);
        $canceledOrdersCountToday = floatval($array[intval(count($array) - 1)]['canceledOrdersCountToday']);
        $canceledOrdersPriceToday = floatval($array[intval(count($array) - 1)]['canceledOrdersPriceToday']);

        return view('admin.dashBoard', compact(
            'thisMonthOrdersEarning',
            'thisMonthOrdersCount',
            'lastMonthOrdersEarning',
            'todayOrdersEarning',
            'todayOrdersCount',
            'pendingOrdersCountToday',
            'pendingOrdersPriceToday',
            'canceledOrdersCountToday',
            'canceledOrdersPriceToday',
        ));

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
        where('finished', '1')->where('accepted', '1')
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

