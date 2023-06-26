<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use DB;
use Carbon\Carbon;

class transactionanalytics extends Controller
{
    public function transactionanalytics()
{
    $endDate = Carbon::today();  // Get the current date
    $startDate = $endDate->copy()->subDays(14);  // Subtract 14 days to get the start date

    $fifteendaysquery = Transactions::selectRaw('COUNT(transaction_id) AS ID, date')
        ->whereDate('date', '>=', $startDate)
        ->whereDate('date', '<=', $endDate)
        ->groupBy('date')
        ->get();
    $fifteen = "";
    foreach ($fifteendaysquery as $val) {
        $fifteen .= "['" . $val->date . "', " . $val->ID . "],";
    }
    $fifteenchart = $fifteen;



    $end30Date = Carbon::today();  // Get the current date
    $start30Date = $endDate->copy()->subDays(29);  // Subtract 29 days to get the start date

    $thirtydaysquery = Transactions::selectRaw('COUNT(transaction_id) AS ID, date')
        ->whereDate('date', '>=', $start30Date)
        ->whereDate('date', '<=', $end30Date)
        ->groupBy('date')
        ->get();

    $thirty = "";
    foreach ($thirtydaysquery as $val) {
        $thirty .= "['" . $val->date . "', " . $val->ID . "],";
    }
    $thirtychart = $thirty;




    $allTimeQuery = Transactions::selectRaw('COUNT(transaction_id) AS ID, DATE_FORMAT(date, "%M %Y") AS month')
        ->groupBy('month')
        ->get();

    $allTime = "";
    foreach ($allTimeQuery as $val) {
        $allTime .= "['Month " . $val->month . "', " . $val->ID . "],";
    }

    $allTimeChart = $allTime;



    $workersQuery = DB::table('transactions')
    ->select('users.name as name', DB::raw('COUNT(transactions.transaction_id) AS ID'))
    ->join('users', 'transactions.User_ID', '=', 'users.User_ID')
    ->groupBy('users.name')
    ->get();


    $workers = "";
    foreach ($workersQuery as $val) {
        $workers .= "['" . $val->name . "', " . $val->ID . "],";
    }

    $workerchart = $workers;
    
    return view('admin.transactionanalytics', compact('fifteenchart',
    'thirtychart','allTimeChart','workerchart'));
}

}
