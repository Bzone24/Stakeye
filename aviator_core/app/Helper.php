<?php

use App\Models\Game;
use App\Models\Gameresult;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Userbit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function synwalletbalancefrommain($userId)
{
    $localUser = User::where('id', $userId)->first();
    if ($localUser) {
        $mainUserInfo = DB::connection('mainsite')->table('users')->where('email', $localUser->email)->first();
        if ($mainUserInfo) {
       
            $balance = $mainUserInfo->balance;
             wallet::where('userid', $userId)->update(['amount' => $balance, 'updated_at' => date("Y-m-d H:i:s")]);
        }
    }
}

function udpateBalanceinMainWallet($userId,$amount, $symbol){
    $localUser = User::where('id', $userId)->first();
    if ($localUser) {
        $mainUserInfo = DB::connection('mainsite')->table('users')->where('email', $localUser->email)->first();
        if ($mainUserInfo) {

     //update in main value
     if($symbol == "+"){
        $postBalance = $mainUserInfo->balance + $amount;
        $details = 'Fund added from aviator game';
        $transType = 'TYPE_USER_TRANSFER_IN';
    }else{
        $postBalance = $mainUserInfo->balance - $amount;
        $details = 'Fund spend at aviator game';
        $transType = 'TYPE_USER_TRANSFER_OUT';
        
     }
     
     DB::connection('mainsite')->table('transactions')->insert([
         'user_id' => $mainUserInfo->id,
         'amount' => $amount,
         'post_balance' => $postBalance,
         'trx_type' => $symbol,
         'trx' => now(),
         'details' => $details,
         'remark' => $details,
         'type' => $transType,
         'created_at' => date("Y-m-d H:i:s"),
     ]);

     DB::connection('mainsite')->table('users')->where("id", $mainUserInfo->id)->update(['balance' => $postBalance]);
}
    }
}
function imageupload($file, $name, $path)
{
    $file_name = "";
    $file_type = "";
    $filePath = "";
    $size = "";

    if ($file) {
        $file_name = $file->getClientOriginalName();
        $file_type = $file->getClientOriginalExtension();
        $fileName = $name . "." . $file_type;
        Storage::disk('public')->put($path . $fileName, File::get($file));
        $filePath = "/" . 'storage/' . $path . $fileName;
    }
    return $file = [
        'fileName' => $file_name,
        'fileType' => $file_type,
        'filePath' => $filePath,
    ];
}
function datealgebra($date, $operator, $value, $format = "Y-m-d")
{
    if ($operator == "-") {
        $date = date_create($date);
        date_sub($date, date_interval_create_from_date_string($value));
        return date_format($date, $format);
    } elseif ($operator == "+") {
        $date = date_create($date);
        date_add($date, date_interval_create_from_date_string($value));
        return date_format($date, $format);
    }
}
function user($parameter, $id = null)
{
    if ($id == null) {
        return session()->get('userlogin')[$parameter];
    } else {
        $data = User::where('id', $id)->first();
        return $data->{$parameter};
    }
    // return session()->get('userlogin')[$parameter];
}
function userdetail($id, $parameter)
{
    $data = User::where('id', $id)->first();
    // dd($data);
    return $data->{$parameter};
}
function admin($parameter)
{
    return session()->get('adminlogin')[$parameter];
}
function wallet($userid, $type = "string")
{
    $amount = Wallet::where('userid', $userid)->first();
    if ($amount->amount > 0) {
        if ($type == "num") {
            return $amount->amount;
        } else {
            return number_format($amount->amount);
        }
    } else {
        return 0;
    }
}
function setting($parameter)
{
    $setting = Setting::where('category', $parameter)->first();
    return $setting->value;
}

function currentid()
{
    // $data = Gameresult::orderBy('id', 'desc')->first();
    $data = Game::where('status', 0)->latest()->first();

    if ($data) {
        return $data->id;
    } else {
        return 0;
    }
}
function dformat($date, $format)
{
    $strd = date_create($date);
    // if (date($format) == date_format($strd, $format)) {
    //     return "Today";
    // }
    return date_format($strd, $format);
}
function resultbyid($id)
{
    $data = Gameresult::where('id', $id)->first();
    if ($data && $data->result != 'pending' && $data->result != '') {
        return $data->result;
    }
    return 0;
}
function userbetdetail($id, $parameter)
{
    $data = Userbit::where('id', $id)->first();
    if ($data) {
        return $data->{$parameter};
    }
    return 0;
}
function addwallet($id, $amount, $symbol = "+")
{
    $wallet = wallet::where('userid', $id)->first();
    if ($wallet) {
        if ($symbol == "+") {
            wallet::where('userid', $id)->update([
                "amount" => wallet($id, 'num') + $amount,
            ]);
            udpateBalanceinMainWallet($id, $amount, $symbol);

            return wallet($id, 'num') + $amount;
        } elseif ($symbol == "-") {
            wallet::where('userid', $id)->update([
                "amount" => wallet($id, "num") - $amount,
            ]);
            udpateBalanceinMainWallet($id, $amount, $symbol);
            return wallet($id, "num") - $amount;
        }
        return wallet($id);
    }
}
function appvalidate($input)
{
    if ($input == '' || $input == null || $input == 0) {
        return 'Not found!';
    } else {
        return $input;
    }
}
function lastrecharge($id, $parameter)
{
    $data = Transaction::where('userid', $id)->where('type', 'credit')->where('category', 'recharge')->orderBy('id', 'desc')->first();
    if ($data) {
        return $data->{$parameter};
    }
    return false;
}
function status($code, $type)
{
    if ($type == 'recharge') {
        if ($code == 0) {
            return array('color' => 'warning', 'name' => 'Pending');
        }
        if ($code == 1) {
            return array('color' => 'success', 'name' => 'Approved');
        }
        if ($code == 2) {
            return array('color' => 'danger', 'name' => 'Cancel');
        }
    } elseif ($type == "user") {
        if ($code == 0) {
            return array('color' => 'danger', 'name' => 'Inactive');
        }
        if ($code == 1) {
            return array('color' => 'success', 'name' => 'Active');
        }
        if ($code == 2) {
            return array('color' => 'warning', 'name' => 'Pending');
        }
    }
}
// function bankdetail($userid,$parameter){
//     Bank_detail::where('userid',);
// }
function platform($id)
{
    if ($id == 2) {
        return 'phonepay';
    } elseif ($id == 3) {
        return 'upi';
    } elseif ($id == 1) {
        return 'gpay';
    } elseif ($id == 9) {
        return 'imps';
    } elseif ($id == 6) {
        return 'netbanking';
    } else {
        return 'other';
    }
}

function addtransaction($userid, $platform, $transactionno, $type, $amount, $category, $remark, $status)
{
    $trn = new Transaction();
    $trn->userid = $userid;
    $trn->platform = $platform;
    $trn->transactionno = $transactionno;
    $trn->type = $type;
    $trn->amount = $amount;
    $trn->category = $category;
    $trn->remark = $remark;
    $trn->status = $status;
    if ($trn->save()) {
        return true;
    }
    return false;
}
