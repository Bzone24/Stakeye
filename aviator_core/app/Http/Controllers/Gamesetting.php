<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Gameresult;
use App\Models\Setting;
use App\Models\AdminSetting;
use App\Models\Userbit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Gamesetting extends Controller
{

    public function crash_plane()
    {
        return 1;
    }
    public function game_existence(Request $r)
    {
        $event = $r->event;
        if ($event == "check") {
            $new = Setting::where('category', 'game_status')->where('value', '0')->first();

            if ($new || (session()->has('gamegenerate') && session()->get('gamegenerate') == 1)) {
                return array('data'=>true);
            }else{
                return array('data'=>false);
            }
            return array('data'=>false);
        }
    }
    public function new_game_generated(Request $r){
        
        $game = Game::where("status",0)->where("game_running",0)->latest()->first();
        
        if($game){
            return response()->json(array("id" => $game->id));
        }else{
            return response()->json(["status"=>"pending"],400);    
        }
            
        
        
        // OLD LOGIC
        // $new = Setting::where('category', 'game_status')->update(['value' => '0']);
        // $r->session()->put('gamegenerate','1');
        // return response()->json(array("id" => currentid()));
    }

    public function increamentor(Request $r){
        $res = 0;
        $adminSetting = AdminSetting::latest()->first();
        
         $game = Game::latest()->first();

        $totalbets = Userbit::where('gameid',currentid())->sum('amount');
        if ($totalbets >0) {

 
            
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
    
    
    

        }else{
            $res = round(mt_rand($adminSetting->without_min_result * 100, ($adminSetting->without_max_result - 1) * 100) / 100, 2);

          
             //$res = (rand($adminSetting->without_min_result, ($adminSetting->without_max_result-1)) . '.' . rand(02, 99));
        }
        /*
        
        if($adminSetting->random_result){
            //$res = floatval(rand(1, 10) . '.' . rand(0, 9));
             $res = (rand($adminSetting->min_result, $adminSetting->max_result));
        }
        else{
            // $res = floatval(rand($adminSetting->min_result, $adminSetting->max_result) . '.' . rand(0, 9));
            $res = 3;
        }*/
        
        $gamestatusdata = Setting::where('category', 'game_status')->first();
        if(!$gamestatusdata) {
            return response()->json(['status' => false, 'message' => 'Game status not found']);
        }
        // $res = 10;
        //$totalbet = Userbit::where('gameid', currentid())->count();
        //$totalamount = Userbit::where('gameid', currentid())->sum('amount');
        // dd($res->result);
         Game::where('id', currentid())->update(['result' => $res]);

        $res1 = Game::latest()->first();
        $res = floatval($res1->result);
       
       
       
        return response()->json(['status' => true, 'result' => base64_encode(base64_encode($res))]);
    }

    // OLD INCREAMENTOR RESULT
    public function increamentorOLD(Request $r){
        $gamestatusdata = Setting::where('category', 'game_status')->first();
        $res = 0;
        if($gamestatusdata){

        $totalbet = Userbit::where('gameid',currentid())->count();
        $totalamount = Userbit::where('gameid',currentid())->sum('amount');
        if ($totalbet == 0) {
            $res =  rand(4,11);
        }else{
            $randomresult = array(1.1,1.1,1.2,1.3,1.4,1.5,1.6,1.7,1.8,1.9);
            $res = $randomresult[rand(0,8)];
        }
        $status = true;
        $result = $res;
        $response = array('status'=>$status,'result'=>$result);
        return response()->json($response);
        }
    }
    // public function increamentor(Request $r)
    // {
    //     // return 1.7;
    //     $totalbet = Userbit::where('gameid',currentid())->count();
    //     $totalamount = Userbit::where('gameid',currentid())->sum('amount');
    //     if ($totalbet == 0) {
    //         return rand(8,11);
    //     }else{
    //         $randomresult = array(1.1,1.1,1.2,1.3,1.4,1.5,1.6,1.7,1.8,1.9);
    //         $res = $randomresult[rand(0,8)];
    //         if (session()->has('result')) {
    //             return session()->get('result');
    //         }
    //         $r->session()->put('result',$res);
    //         return $res;
    //     }
    //     return rand(setting('start_range_game_timer')*10, setting('end_range_game_timer')*10) / 10;
    // }
    
    public function game_over(Request $r){
        $r->session()->forget('result');
        // $result = Gameresult::where('id', currentid())->update([
        //     "result" => number_format($r->last_time, 2),
        // ]);
        $currentId = currentid();
        $currentId = $currentId-1;
        $result = Game::where('id', $currentId)->update([
            'status' => 1,
            'game_running' => "1",
        ]);
            $currentDateTime = Carbon::now();

        // Add 30 seconds to the current date and time
        $newDateTime = $currentDateTime->addSeconds(60);

        Game::where('id', currentid())->update([
            'game_running' => "1",
         
            'update_time' => $newDateTime
            
            
        ]);
        
  
        $alluserbit = Userbit::where('gameid', currentid())->where('status', 0)->get();
        foreach ($alluserbit as $key) {
			//if(floatval($r->last_time) <= 1.20){
			// $result = 0;
		    // }else{
			// $result = $r->last_time;
			// }
            $result = $r->last_time;
            $finalamount = floatval($key->amount) * floatval($result);
            Userbit::where('id', $key->id)->update(["status"=> 1]);
            // addwallet($key->userid,$finalamount);
        }
        $new = Setting::where('category', 'game_status')->update(['value' => '0']);
        $r->session()->put('gamegenerate','0');
        $result = new Gameresult;
        $result->result = "pending";
        $result->save();
        return wallet(user('id'));
    }
    public function game_over1(Request $r){
        $r->session()->forget('result');
        // $result = Gameresult::where('id', currentid())->update([
        //     "result" => number_format($r->last_time, 2),
        // ]);
        $currentId = currentid();
        $currentId = $currentId-1;
        $result = Game::where('id', $currentId)->update([
            'status' => 1,
            'game_running' => "1",
        ]);
        $result = Game::where('id', currentid())->update([
            'game_running' => "1",
        ]);
        $alluserbit = Userbit::where('gameid', currentid())->where('status', 0)->get();
        foreach ($alluserbit as $key) {
			if(floatval($r->last_time) <= 1.20){
			$result = 0;
		    }else{
			$result = $r->last_time;
			}
            $finalamount = floatval($key->amount) * floatval($result);
            Userbit::where('id', $key->id)->update(["status"=> 1]);
            // addwallet($key->userid,$finalamount);
        }
        $new = Setting::where('category', 'game_status')->update(['value' => '0']);
        $r->session()->put('gamegenerate','0');
        $result = new Gameresult;
        $result->result = "pending";
        $result->save();
        return wallet(user('id'));
    }

    public function betNow(Request $r)
    {
        $status = false;
        $message = "Something went wrong!";
        $returnbets = array();
        for($i=0; $i < count($r->all_bets); $i++){
		$result = new Userbit;
        $result->userid = user('id');
        $result->amount = $r->all_bets[$i]['bet_amount'];
        $result->type = $r->all_bets[$i]['bet_type'];
        $result->gameid = currentid();
        $result->section_no = $r->all_bets[$i]['section_no'];
        if ($r->all_bets[$i]['bet_amount'] < wallet(user('id'), 'num')) {
            if ($result->save()) {
                $status = true;
                array_push($returnbets, [
                    "bet_id" => $result->id,
                ]);
				/*array_push($returnbets, [
                    "bet_id" => currentid(),
                ]);*/
                $exact_wallet_balance = addwallet(user('id'), floatval($r->all_bets[$i]['bet_amount']), "-");
                $data = array(
                    "wallet_balance" => wallet(user('id')),
                    "return_bets" => $returnbets
                );
                $message = "";
            }
        } else {
            $status = false;
            $data = array();
            $message = "Insufficient fund!!";
        }
		}
        $response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
    }
    public function currentlybet(){
        $allbets = Userbit::where("gameid", currentid())->join('users','users.id','=','userbits.userid')->get();
        $currentGameBet = $allbets;
        for ($i=0; $i < rand(400,900); $i++) {
            $currentGameBet[]=array(
                "userid" => rand(200,2000),
                "amount" => (rand(50,15000)*10),
				"image"  => url("/images/avtar/av-".rand(1,72).".png")
            );
        }
        $currentGame = array("id"=>currentid());
        $currentGameBetCount = count($currentGameBet);
        $response = array("currentGame" => $currentGame, "currentGameBet" => $currentGameBet, "currentGameBetCount" => $currentGameBetCount);
        return response()->json($response);
    }
    public function my_bets_history(){
        $userid = user('id');
        $userbets = Userbit::where("userid", $userid)->where('status',1)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        return response()->json($userbets);
    }
	public function cashout(Request $r){
		$game_id = $r->game_id;
		$bet_id = $r->bet_id;
		$win_multiplier = $r->win_multiplier;
		$cash_out_amount = 0;
		$status = false;
        $message = "";
        $data = array();
		$result = resultbyid($game_id) == 0 ? $win_multiplier : resultbyid($game_id);
		if(floatval($result) <= 1.20){
		//	$result = 0;
		}
		$cash_out_amount = floatval(userbetdetail($bet_id,'amount'))*floatval($result);
		addwallet(user('id'),$cash_out_amount);
		$data = array(
                    "wallet_balance" => wallet(user('id'),"num"),
                    "cash_out_amount" => $cash_out_amount
                );
        Userbit::where('id', $bet_id)->update(["status"=> 1,"cashout_multiplier"=>$win_multiplier]);
        $status = true;
		//$response = array("isSuccess" => $status, "data" => $data, "message" => $message);
			$response = array("isSuccess" => $status, "data" => $data, "message" => $message,'other'=>Userbit::where("gameid", $game_id)->where('status',0)->count());
        return response()->json($response);
	}

	public function cronjob(){
	    //0 = Game end & statrting soon
	    //1 = Game start & and is in proccess
	    $gamestatusdata = Setting::where('category', 'game_status')->first();
	    $game_status = 0;
	    if($gamestatusdata){
	        $game_status = $gamestatusdata->value;
	    }
	    if($game_status == 1){
            $last_start_time = Setting::where('category', 'game_start_time')->first()->value;
            $last_till_time = Setting::where('category', 'game_between_time')->first()->value;
            $bothdifference = datealgebra($last_start_time, '+', ($last_till_time/1000).' seconds', $format = "Y-m-d h:i:s");
	    if(strtotime(date('Y-m-d h:i:s')) >= strtotime($bothdifference)){
	        $gamestatusdata = Setting::where('category', 'game_status')->update([
	             "value"  => 0
	             ]);
	    }
	    }elseif($game_status == 0){
	         $gamestatusdata = Setting::where('category', 'game_status')->update(["value"  => 1]);
	       //  $gamestatusdata = Setting::where('category', 'game_start_time')->update(["value"  => date('Y-m-d h:i:s')]);
	       //  $gamestatusdata = Setting::where('category', 'game_between_time')->update(["value"  => 5000]);
	    }else{}
	}
}
