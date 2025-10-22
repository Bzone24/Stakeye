<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameresult;
use App\Models\Userbit;
use App\Models\Setting;
use App\Models\User;
use App\Models\Bank_detail;
use App\Models\Bankdetail;
use App\Models\AdminSetting;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class Pages extends Controller
{
    public function aviator() {
        //$allresults = Game::orderBy('id', 'desc')->skip(1)->take(10)->get();
        $allresults = Game::orderBy('id', 'desc')->where('game_running',1)->take(10)->get();

        $mybets = Userbit::where('userid',user('id'))->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        $nextGame = Game::where('status', 0)->where('game_running',0)->latest()->first();
            Game::where("status",0)->where('game_running',0)->where("update_time",'<', Carbon::now())->delete();
        if(!$nextGame){
           
                $res = 0;
                Game::where("status",0)->orWhere('game_running',0)->update(['status'=>1, 'game_running'=>1]);
            
                $adminSetting = AdminSetting::latest()->first();
            
                    $min = floatval($adminSetting->min_result);
                    $max = floatval($adminSetting->max_result);
            
                   
            
            
                if($adminSetting->random_result){
                     $res = mt_rand($min * 100, $max * 100) / 100;
                    //$res = floatval(rand(1, 10) . '.' . rand(0, 9));
                    //$res = (rand($adminSetting->min_result, ($adminSetting->max_result-1)). '.' . rand(02, 99));
                }else{
                    // $res = floatval(rand($adminSetting->min_result, $adminSetting->max_result) . '.' . rand(0, 9));
                    //$res = ($adminSetting->max_result-1). '.' . rand(02, 99);
                    $res = number_format($adminSetting->max_result, 2, '.', '');
                }
    
          
            $lastGameId = Game::latest('id')->value('id') ?? 0;
            
            $lastGame = Game::orderBy('id', 'desc')->first();
    
            $game = new Game;
            $game->game = Carbon::now()->toDateTimeString() . "_" . $lastGameId;
            $game->result = $res;
            $game->status = 0;
            $game->update_time =  Carbon::now()->addSeconds(40)->setTimezone('Asia/Kolkata');
            $game->save();
             $nextGame = Game::where('status', 0)->where('game_running',0)->latest()->first();
        }
      
        
        
        $upCommingResult = Game::latest()->limit(20)->get();
        $user1 = Session::get('userlogin');
        $user = User::where('id', $user1->id)->first();
        // dd($user);
        // dd($upCommingResult->toArray());
        return view('crash',compact("allresults","mybets", 'nextGame', 'upCommingResult', 'user'));
    }

    public function deposit() {
        $bank = Bank_detail::where('userid',user('id'))->first();
        if (!$bank) {
            $bank = array();
        }
        $setting = Setting::where('category' , 'min_recharge')->first();
        $adminSettings = AdminSetting::latest()->first();
        // dd($setting);
        return view('deposite',compact('bank', 'setting', 'adminSettings'));
    }

    public function amount_transfer()
    {
        $specificdata = null;
        $title = 'Amount Transfer';
        return view('amount_transfer', [
            'title' => $title,
        ]);
    }

    public function withdraw(){
        // dd(Session::get('userlogin'));
        $userDetails = Session::get('userlogin');
        $bank = Bank_detail::where('userid', $userDetails->id)->latest()->first();
        // dd($withdraw->toArray());
        return view('withdraw', compact('bank', 'userDetails'));
    }

    public function level_management() {
        $mypromocode = user('id');
        $level1users = User::where('promocode',$mypromocode)->get();
        $users = count($level1users);
        $level1 = $level1users;
        $level2 = array();
        $level3 = array();
        foreach ($level1users as $key2) {
            $level2users = User::where('promocode',$key2->id)->get();
            $users += count($level2users);
            if (count($level2users) > 0) {
                array_push($level2,$level2users);
            }
            foreach ($level2users as $key3) {
                $level3users = User::where('promocode',$key3->id)->get();
                $users += count($level3users);
                array_push($level3,$level3users);
            }
        }
        return view('level_management',compact('users','level1','level2','level3'));
    }
}
