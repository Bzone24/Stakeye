<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Gamesetting;
use App\Http\Controllers\Pages;
use App\Http\Controllers\Userdetail;
use App\Http\Controllers\Adminapi;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('gameini', function() {
    Artisan::call('game:generate-new');
    return "Command executed successfully!";
}); 
 
 
Route::get('gamenextresult', [Admin::class, 'gameResultShowInApp'])->name('gamenextresult');
Route::get('/storagelink', function () {
    $target = '/home/admin/web/aviator.xhost.co.in/public_html/storage/app/public/';
    $shortcut = '/home/admin/web/aviator.xhost.co.in/public_html/storage/';
    symlink($target, $shortcut);
    dd('storage link successfully');
});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    dd('Cache cleared successfully');
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/privacypolicy', function () {
    return view('privacypolicy');
});
// Auth Login
Route::get('/autologin/{id}', [Authentication::class, "doautologin"]);
Route::get('/admin-autologin', [Authentication::class, "doadminautologin"]);

Route::post('/auth/login', [Authentication::class, "login"]);

Route::post('/auth/register', [Authentication::class, "register"]);
Route::post('forget', [Authentication::class, 'forget'])->name('forget');
Route::post('verify_otp', [Authentication::class, 'verify_otp'])->name('verify_otp');
Route::post('reset_password', [Authentication::class, 'reset_password'])->name('reset_password');

Route::get('/is_login', [Userdetail::class, "is_login"]);
Route::get('/game-cron', [Gamesetting::class, "cronjob"]);
// Auth Admin Login
Route::post('/auth/admin/login', [Authentication::class, "adminlogin"]);

// GET OTP
Route::post('getotp', [Authentication::class, 'getOtp'])->name('getotp');

// Admin Login
Route::get('/admin', [Admin::class, "login"]);
Route::group(['prefix' => 'admin/', 'middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', [Admin::class, "dashboard"])->name('dashboard');
    Route::get('/user-list', [Admin::class, "userlist"])->name('userlist');
    Route::get('/todayuserlist', [Admin::class, "todayuserlist"])->name('todayuserlist');
    Route::get('/blockeduser', [Admin::class, "blockeduser"])->name('blockeduser');
    Route::get('changeresultstatus/{userid}', [Admin::class, "changeResultStatus"])->name('changeresultstatus');
    Route::get('/change-password', [Admin::class, "chagepassword"])->name('changepassword');
    Route::get('/user/edit/{id}', [Admin::class, "useredit"])->name('useredit');
    Route::get('/user/view/{id}', [Admin::class, "viewUser"])->name('viewuser');
    Route::post('/user/addmoney/', [Admin::class, "addUserMoney"])->name('addusermoney');
    Route::post('/user/changestatus/', [Admin::class, "changeUserStatus"])->name('changeuserstatus');
    Route::get('/recharge-history', [Admin::class, "rechargehistory"])->name('rechargehistory');
    Route::get('/todayrechargehistory', [Admin::class, "todayRechargeHistory"])->name('todayrechargehistory');
    Route::get('/withdrawal-history', [Admin::class, "withdrawalhistory"])->name('withdrawhistory');
    Route::get('/amount-setup/{id?}', [Admin::class, "amountsetup"])->name('amount-setup');
    Route::get('/bank-detail', [Admin::class, "bankdetail"])->name('bankdetails');
    Route::get('adminsettings', [Admin::class, 'adminSettings'])->name('adminsettings');
    Route::post('adminsettings', [Admin::class, 'updateAdminSettings'])->name('adminsettings');
    Route::get('gameresult', [Admin::class, 'gameResult'])->name('gameresult');

    Route::group(['prefix' => 'api/'], function () {
        Route::post('/changepassword', [Adminapi::class, "changepassword"]);
        Route::post('/edituser', [Adminapi::class, "edituser"]);
        Route::post('/recharge/{event}', [Adminapi::class, "rechargeapproval"]);
        Route::post('/withdraw/{event}', [Adminapi::class, "withdrawalapproval"]);
        Route::post('/user/delete', [Adminapi::class, "userdelete"]);
        Route::post('/editamountsetup', [Adminapi::class, "editamountsetup"]);
        Route::post('/bankdetail', [Adminapi::class, "editbankdetail"]);
        Route::post('/updatewallet', [Adminapi::class, "updatewallet"]);
    });

    Route::get('/logout', [Admin::class, "logout"]);
});

Route::group(['middleware' => ['isUser']], function () {
    Route::get('/profile', [Userdetail::class, "profile"]);
    Route::get('/crash', [Pages::class, "aviator"]);
    Route::get('/deposit', [Pages::class, 'deposit']);
    Route::get('/amount-transfer', [Pages::class, "amount_transfer"]);
    Route::get('/withdraw', [Pages::class, 'withdraw'])->name('withdraw');
    Route::get('/referal', function () {
        return view('refferal');
    });
    Route::get('/level-management', [Pages::class,'level_management']);
    
    Route::get('/deposit_withdrawals', [Userdetail::class, "deposit_withdrawal"])->name('deposit_withdrawals');
    Route::get('/logout', function () {
        if (session()->has('userlogin')) {
            session()->forget('userlogin');
        }
        return redirect('/');
    })->name('logout');
    Route::get('/bidhistory', [Userdetail::class, 'bidHistory'])->name('bidhistory');
    //Api
    Route::get('/get_user_details', [Userdetail::class, "get_user_detail"]);
    // Api Lists App Createion

    //Data api
    Route::post('/user/withdrawal_list', [Userdetail::class, "withdrawal_list"]);
    Route::post('/game/existence', [Gamesetting::class, "game_existence"]);
    Route::post('/game/crash_plane', [Gamesetting::class, "crash_plane"]);
    Route::post('/game/new_game_generated', [Gamesetting::class, "new_game_generated"]);
    Route::post('/game/increamentor', [Gamesetting::class, "increamentor"]);
    Route::post('/game/game_over', [Gamesetting::class, "game_over"]);
    Route::post('/game/add_bet', [Gamesetting::class, "betNow"]);
	Route::get('/cash_out', [Gamesetting::class, "cashout"]);
    Route::post('/game/currentlybet', [Gamesetting::class, "currentlybet"]);
    Route::post('/game/my_bets_history', [Gamesetting::class, "my_bets_history"]);
    Route::get('/payment_gateway_details', [Adminapi::class, "payment_gateway"]);
    Route::post('/insert/withdrawal', [Adminapi::class, "withdrawal_query"]);
    Route::post('/depositNow', [Adminapi::class, "depositNow"]);
    Route::post('/upidepositnow', [Adminapi::class, "upiDepositNow"])->name('upidepositnow');
    Route::post('/wallet_transfer', [Userdetail::class, "wallet_transfer"]);
    Route::post('verifytransaction', [Userdetail::class, 'verifyTransaction'])->name('verifytransaction');
});
