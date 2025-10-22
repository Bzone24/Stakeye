<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\Bank_detail;
use App\Models\Bankdetail;
use App\Models\Gameresult;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Userbit;
use App\Models\Wallet;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function login()
    {
        return view("admin.login");
    }
    public function dashboard(){
        $user = User::where('isadmin', 0)->count();
        $todayUsersCount = User::where('isadmin', 0)->whereDate('created_at', Carbon::today())->count();
        $blockUser = User::where('isadmin', 0)->where('status', 0)->count();
        $recharge = Transaction::where('category', 'recharge')->where('remark', 'Success')->sum('amount');
        $rechargeToday = Transaction::where('category', 'recharge')->whereDate('created_at', Carbon::today())->where('remark', 'Success')->sum('amount');
        $withdrawal = Transaction::where('category', 'withdraw')->sum('amount');
        $profitAndLoss = (int)$recharge - (int)$withdrawal ;
        $totalGames = Gameresult::where('result', '!=', 'pending')->count();
        
        // WITHDRAWAL HISTORY 
        $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->orderBy('transactions.id','desc')->get();
        $title = 'Withdrawal Hitory';
        // dd($history->toArray());
        $rechargeHistory = Transaction::where('category', 'recharge')
                              ->where('type', 'credit')
                              ->where('status', '!=', 1)
                              ->whereDate('created_at', Carbon::today())
                              ->orderBy('id', 'desc')
                              ->get();
        
        $withdrawal; // PROFIT AND LOSS
        return view("admin.dashboard", [
            "user" => $user,
            "todayUsersCount" => $todayUsersCount,
            "blockUser" => $blockUser,
            "recharge" => $recharge,
            "rechargeToday" => $rechargeToday,
            "withdrawal" => $withdrawal,
            "profitAndLoss" => $profitAndLoss,
            "totalGames" => $totalGames,
            "history" => $history,
            "rechargeHistory" => $rechargeHistory,
        ]);
    }
    public function userlist()
    {
        $userlist = User::where('isadmin', 0)->latest()->get();
        // dd($userlist->toArray());
        return view("admin.userlist", compact("userlist"));
    }
    //CHANGE RESULT STATUS
    public function changeResultStatus($userid){
        $user = User::where('id', $userid)->first();
        if($user->show_result)
            User::where('id', $userid)->update(['show_result' => "0"]);
        
        else
            User::where('id', $userid)->update(['show_result' => "1"]);
        
        return redirect()->back()->with('success', 'user status update...');
    }
    public function todayuserlist()
    {
        $userlist = User::where('isadmin', 0)
        ->whereDate('created_at', Carbon::today())
        ->latest()
        ->get();
        return view("admin.todayuserlist", compact("userlist"));
    }
    public function blockeduser(){
        $userlist = User::where('isadmin', 0)->where('status', 0)->latest()->get();
        return view("admin.userlist", compact("userlist"));
    }
    public function useredit($id)
    {
        $user = User::where('isadmin', 0)->where('id', $id)->first();
        return view("admin.useredit", compact("user"));
    }
    public function viewUser($id){
        $user = User::where('id', $id)->first();
        $walletBalance = Wallet::where('userid', $id)->first();
        $transactions = Transaction::where('userid', $id)->get();
        $wallet = Wallet::where('userid', $id)->get();
        $userBid = Userbit::where('userid', $id)->get();
        $bankDetails = Bank_detail::where('id', $id)->first();
        return view("admin.userdetails", compact("transactions", 'wallet', 'userBid', 'user', 'walletBalance', 'bankDetails'));
    }
    public function addUserMoney(Request $request){
        addwallet($request->user_id, $request->amount);
        $transNo = mt_rand(10000, 99999);
        addtransaction($request->user_id, 'Added By Admin', $transNo , 'credit', $request->amount, 'recharge', 'Success', 1);
        return redirect()->back()->with('success', 'Money Added...');
    }
    public function changeUserStatus(Request $request){
        // dd($request->toArray());
        $updateUserStatus = User::where('id', $request->userId)->update([
            'status' => $request->status
        ]);
        if($updateUserStatus)
            return response()->json(["status"=>"success", "message"=>'user status updated successfully...'], 200);
    }
    public function chagepassword()
    {
        return view('admin.changepassword');
    }
    public function rechargehistory()
    {
        $history = Transaction::where('category', 'recharge')->where('type', 'credit')->orderBy('id','desc')->get();
        $title = 'Recharge Hitory';
        // dd($history->toArray());
        return view('admin.rechargehistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function todayRechargeHistory(){
        $today = Carbon::today();
        $history = Transaction::where('category', 'recharge')
                            ->where('type', 'credit')
                            ->whereDate('created_at', $today)
                            ->orderBy('id', 'desc')
                            ->get();

        $title = 'Today\'s Recharge History';

        return view('admin.todayrechargehistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function withdrawalhistory(){
        $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->orderBy('transactions.id','desc')->get();
        $title = 'Withdrawal Hitory';
        // dd($history);
        return view('admin.withdrawhistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function amountsetup($id = null)
    {
        $specificdata = null;
        $settings = Setting::get();
        $title = 'Withdrawal Hitory';
        if ($id != null) {
            $specificdata = Setting::where('id', $id)->first();
        }
        return view('admin.amountsetup', [
            'setting' => $settings,
            'id' => $id,
            'specificdata' => $specificdata,
        ]);
    }
    public function bankdetail()
    {
        $specificdata = null;
        $title = 'Bank Detail';
        $specificdata = Bankdetail::where('id', '1')->first();
        return view('admin.bankdetail', [
            'bank' => $specificdata,
        ]);
    }
    public function logout()
    {
        if (session()->has('adminlogin')) {
            session()->forget('adminlogin');
        }
        return redirect('/admin');
    }
    public function adminSettings(){
        $adminSettings = AdminSetting::latest()->first();
        return view('admin.adminsettings', compact('adminSettings'));
    }
    public function updateAdminSettings(Request $request){
        AdminSetting::where('id', 1)->update([
            'insatgram'=> $request->instagram,
            'facebook'=> $request->facebook,
            'telegram'=> $request->telegram,
            'linkedin'=> $request->linkedin,
            'twitter'=> $request->twitter,
            'upi_id'=> $request->upi_id,
            'whatasapp_no'=> $request->whatasapp_no,
            'random_result'=> $request->random_result == "on" ? "1" : "0",
            'min_result'=> $request->min_result,
            'max_result'=> $request->max_result,
            'min_withdraw'=> $request->min_withdraw,
            'min_withdraw_time'=> $request->min_withdraw_time,
            'max_withdraw_time'=> $request->max_withdraw_time,
            
             'without_min_result'=> $request->without_min_result,
            'without_max_result'=> $request->without_max_result,
            
            'min_deposite'=> $request->min_deposite,
            'wallet_bonus'=> $request->wallet_bonus,
            
        ]);
        return redirect()->back()->with('success', 'admin setting updated...');
    }
    
    public function gameResult(){
        $gameResult = Game::latest()->paginate(10);
        return view('admin.gameresult', compact('gameResult'));
    }
    public function gameResultShowInApp(){
        $gameResult = Game::latest()->paginate(10);
        return view('admin.gameresultinapp', compact('gameResult'));
    }
}
