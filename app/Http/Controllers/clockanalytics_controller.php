<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Transactions;
use Carbon\Carbon;
use App\Models\ClockModel;

class clockanalytics_controller extends Controller
{
    public function clock_analytics(){

        $endDate = Carbon::today();  // Get the current date
    $startDate = $endDate->copy()->subDays(14);  // Subtract 14 days to get the start date

    $fifteendaysquery = DB::table('clock')
    ->select('status', DB::raw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) AS checkin_count'), DB::raw('COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) AS checkout_count'))
    ->whereBetween('date', [$startDate, $endDate]) // Add the date range condition
    ->groupBy('status')
    ->havingRaw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) > 0 OR COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) > 0')
    ->get();

        $fifteen = "";
        foreach ($fifteendaysquery as $val) {
        $fifteen .= "['" . $val->status . "', " . $val->checkin_count . ", " . $val->checkout_count . "],";
}

        $fifteenchart = rtrim($fifteen, ','); // Remove trailing comma




    $end30Date = Carbon::today();  // Get the current date
    $start30Date = $endDate->copy()->subDays(29);  // Subtract 29 days to get the start date

    $thirtydaysquery = DB::table('clock')
    ->select('status', DB::raw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) AS checkin_count'), DB::raw('COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) AS checkout_count'))
    ->whereBetween('date', [$start30Date, $end30Date])
    ->groupBy('status')
    ->havingRaw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) > 0 OR COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) > 0')
    ->get();

    $thirty = "";
    foreach ($thirtydaysquery as $val) {
        $thirty .= "['" . $val->status . "', " . $val->checkin_count . ", " . $val->checkout_count . "],";
    }
    $thirtychart = $thirty;




    $allTimeQuery = DB::table('clock')
    ->select('status', DB::raw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) AS checkin_count'), DB::raw('COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) AS checkout_count'))
    ->groupBy('status')
    ->havingRaw('COUNT(CASE WHEN checkin IS NOT NULL THEN 1 END) > 0 OR COUNT(CASE WHEN checkout IS NOT NULL THEN 1 END) > 0')
    ->get();


    $allTime = "";
    foreach ($allTimeQuery as $val) {
        $allTime .= "['" . $val->status . "', " . $val->checkin_count . ", " . $val->checkout_count . "],";
    }

    $allTimeChart = $allTime;



    $workersQuery = DB::table('clock')
    ->select('users.name as name', DB::raw('COUNT(clock.clock_id) AS ID'))
    ->join('users', 'clock.User_ID', '=', 'users.User_ID')
    ->groupBy('users.name')
    ->get();


    $workers = "";
    foreach ($workersQuery as $val) {
        $workers .= "['" . $val->name . "', " . $val->ID . "],";
    }

    $workerchart = $workers;
    
    


    return view('admin/clock-analytics', compact('fifteenchart',
    'thirtychart','allTimeChart','workerchart'));


    }
}
