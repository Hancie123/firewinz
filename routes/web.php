<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\userscontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\roomcontroller;
use App\Http\Controllers\customercontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\paymentcontroller;
use App\Http\Controllers\transactioncontroller;
use App\Http\Controllers\workercontroller;
use App\Http\Controllers\accesscontroller;
use App\Http\Controllers\workertransactioncontroller;
use App\Http\Controllers\expensescontroller;
use App\Http\Controllers\clockcontroller;
use App\Http\Controllers\announcementcontroller;
use App\Http\Controllers\chatcontroller;
use App\Http\Controllers\shiftreportcontroller;
use App\Http\Controllers\transactionanalytics;
use App\Http\Controllers\clockanalytics_controller;
use App\Http\Controllers\rulesregulation_controller;
use App\Http\Controllers\user_profile_controller;
use App\Http\Controllers\cashin_cashout_controller;
use App\Models\RoomsModel;
use App\Models\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/',[logincontroller::class,'login']);
Route::post('/',[logincontroller::class,'logincheck']);
Route::get('/admin/dashboard/logout',[admincontroller::class,'logout']);

Route::get('/admin/dashboard',[admincontroller::class,'admin'])->middleware('isLoggedIn','adminstatus');
Route::post('/users',[userscontroller::class,'saveusers'])->middleware('isLoggedIn','adminstatus');

Route::get('/admin/workers/create',[userscontroller::class,'workeraccounts'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/workers/create',[userscontroller::class,'insertworkeraccount'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/workers/ajax',[userscontroller::class,'workerdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/workers/accesscontrol',[accesscontroller::class,'accessworker'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/workers/accesscontrol',[accesscontroller::class,'insertdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/workers/accessajax',[accesscontroller::class,'accesscontroltable'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/workers/delete/{id}', [accesscontroller::class, 'deleteAccessControl'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/workers/disableaccount/{id}',[userscontroller::class,'deleteworkeraccount'])->middleware('isLoggedIn','adminstatus');

Route::get('/admin/rooms/create',[roomcontroller::class,'rooms'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/rooms/create',[roomcontroller::class,'insertdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/roomsdata', function () {
    $rooms = RoomsModel::select('room_id', 'room_name', 'name')
                 ->join('users', 'rooms.User_ID', '=', 'users.User_ID')
                 ->get();
    return response()->json(['data' => $rooms]);
});

Route::get('/admin/customers/create',[customercontroller::class,'customer'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/customers/create',[customercontroller::class,'insertdata'])->middleware('isLoggedIn');
Route::get('/admin/customers/ajax',[customercontroller::class,'getCustomers'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/customers/view',[customercontroller::class,'viewcustomer'])->middleware('isLoggedIn','adminstatus');

Route::get('/admin/expenses/create',[expensescontroller::class,'expenses'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/expenses/create',[expensescontroller::class,'insertdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/expenses/ajaxtable',[expensescontroller::class,'getexpenses'])->middleware('isLoggedIn','adminstatus');

Route::get('/admin/products/create',[productcontroller::class,'products'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/products/create',[productcontroller::class,'insertdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/products/ajax',[productcontroller::class,'getProductsAndRooms'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/products/view',[productcontroller::class,'viewproducts'])->middleware('isLoggedIn','adminstatus');


Route::get('/admin/payments/create',[paymentcontroller::class,'payment'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/payments/create',[paymentcontroller::class,'insertdata'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/payments/ajax',[paymentcontroller::class,'getpaymenttable'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/payments/view',[paymentcontroller::class,'viewpayments'])->middleware('isLoggedIn','adminstatus');


Route::get('/admin/transactions/create',[transactioncontroller::class,'transactions'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/transactions/create',[transactioncontroller::class,'insertdata'])->middleware('isLoggedIn');
Route::get('/admin/transactions/ajax',[transactioncontroller::class,'getTransactions'])->middleware('isLoggedIn');
Route::get('/admin/transactions/view',[transactioncontroller::class,'viewtransactions'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/transactions/delete/{id}', [transactioncontroller::class, 'deletetransaction'])->middleware('isLoggedIn','adminstatus');

Route::get('/admin/announcement/create',[announcementcontroller::class,'announce'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/announcement/create',[announcementcontroller::class,'makeannouncement'])->middleware('isLoggedIn','adminstatus');
Route::get('/admin/announcement/delete/{id}',[announcementcontroller::class,'deletedata'])->middleware('isLoggedIn','adminstatus');


Route::get('/admin/chat',[chatcontroller::class,'adminchat'])->middleware('isLoggedIn','adminstatus');
Route::post('/admin/chat',[chatcontroller::class,'insertchat'])->middleware('isLoggedIn');


Route::get('/admin/shiftreport/view', [shiftreportcontroller::class, 'adminviewshifttable'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/shiftreport/ajax', [shiftreportcontroller::class, 'gettabledata'])->middleware(['isLoggedIn', 'adminstatus']);

Route::get('/admin/clockreport/view', [clockcontroller::class, 'clockreportpage'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/clockreport/ajax', [clockcontroller::class, 'clockreport'])->middleware(['isLoggedIn', 'adminstatus']);

Route::get('/admin/firewinz-rules-regulations/view', [rulesregulation_controller::class, 'rulesregulation'])->middleware(['isLoggedIn', 'adminstatus']);
Route::post('/admin/firewinz-rules-regulations/insert', [rulesregulation_controller::class, 'insertdata'])->middleware(['isLoggedIn', 'adminstatus']);
Route::post('/admin/firewinz-rules-regulations/edit/{id}', [rulesregulation_controller::class, 'edit'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/firewinz-rules-regulations/delete/{id}', [rulesregulation_controller::class, 'delete'])->middleware(['isLoggedIn', 'adminstatus']);

Route::get('/admin/profile', [user_profile_controller::class, 'adminprofile'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/worker/profile', [user_profile_controller::class, 'workerprofile'])->middleware(['isLoggedIn', 'workerstatus']);
Route::post('/admin/profile/changepassword', [user_profile_controller::class, 'changepassword'])->middleware(['isLoggedIn']);

Route::get('/admin/firewinz-analytics/transaction-analytics', [transactionanalytics::class, 'transactionanalytics'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/firewinz-analytics/clock-analytics', [clockanalytics_controller::class, 'clock_analytics'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/firewinz-analytics/cashin-cashout-analytics', [cashin_cashout_controller::class, 'cashin_cashout'])->middleware(['isLoggedIn', 'adminstatus']);
Route::get('/admin/firewinz-analytics/cashin-cashout-analytics/search', [cashin_cashout_controller::class, 'searchresult'])->middleware(['isLoggedIn', 'adminstatus']);



Route::post('/admin/newclockin',[clockcontroller::class,'newclockindata'])->middleware('isLoggedIn'); 
Route::post('/admin/clockin',[clockcontroller::class,'checkindata'])->middleware('isLoggedIn'); 
Route::post('/admin/clockout',[clockcontroller::class,'checkoutdata'])->middleware('isLoggedIn'); 
Route::post('/admin/statuscheckin',[clockcontroller::class,'checkcheckin'])->middleware('isLoggedIn'); 

Route::get('/worker/dashboard', [workercontroller::class, 'dashboard'])
    ->middleware(['isLoggedIn', 'workerstatus']);
Route::post('/worker/dashboard', [workercontroller::class, 'switchrooms'])->middleware(['isLoggedIn', 'workerstatus']);


Route::get('/worker/transactions/create', [workertransactioncontroller::class, 'transaction'])->middleware(['isLoggedIn', 'workerstatus']);
Route::get('/worker/transactions/view', [workertransactioncontroller::class, 'viewtransactions'])->middleware(['isLoggedIn', 'workerstatus']);
Route::get('/worker/transactions/ajax', [workertransactioncontroller::class, 'getTransactions'])->middleware(['isLoggedIn', 'workerstatus']);


Route::get('/worker/shiftreport/create', [shiftreportcontroller::class, 'shiftreport'])->middleware(['isLoggedIn', 'workerstatus']);
Route::post('/worker/shiftreport/create', [shiftreportcontroller::class, 'saveshiftdata'])->middleware(['isLoggedIn', 'workerstatus']);


Route::get('/worker/chat', [chatcontroller::class, 'workerchat'])->middleware(['isLoggedIn', 'workerstatus']);

Route::post('/users',[userscontroller::class,'saveusers']);