<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Userbit;
use App\Models\Setting;
use App\Models\AdminSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Console\Command;

class NewGameGeneratedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:generate-new';
    protected $description = 'Generate a new game if it\'s the right time';


    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
        public function handle(Request $r){
            $res = 0;
            $adminSetting = AdminSetting::latest()->first();
            //if($adminSetting->random_result){
                //$res = floatval(rand(1, 10) . '.' . rand(0, 9));
              //  $res = rand($adminSetting->min_result * 100, $adminSetting->max_result * 100) / 100;
                
            //}
           // else{
                //$res = (rand($adminSetting->min_result, $adminSetting->max_result));
              //   $res =  $adminSetting->max_result;
                // $res = 4;
            //}
            // $res = 5;
            


            $game = Game::latest()->first();

            $totalbets = Userbit::where('gameid',currentid())->sum('amount');
            if ($totalbets >0) {
    
                if($adminSetting->random_result){
                    //$res = floatval(rand(1, 10) . '.' . rand(0, 9));
                    $res = (rand($adminSetting->min_result, ($adminSetting->max_result-1)). '.' . rand(0, 99));
                }else{
                    // $res = floatval(rand($adminSetting->min_result, $adminSetting->max_result) . '.' . rand(0, 9));
                  //  $res = $adminSetting->max_result;
                      $res = ($adminSetting->max_result-1).".".rand(0,99);
                }
    
            }else{
                $res = (rand($adminSetting->without_min_result, ($adminSetting->without_max_result-1)). '.' . rand(0, 99));
            }

            
            $lastGame = Game::orderBy('id', 'desc')->first();
    
            // INSERT GAME AFTER 1 MINUTE
            if(!$lastGame)
                $lastGame = 1;
            $game = new Game;
            $game->game = Carbon::now()->toDateTimeString() . "_" . $lastGame->id;
            $game->result = $res;
            $game->status = 0;
            //$game->update_time = $lastGame->created_at->addMinutes(1)->setTimezone('Asia/Kolkata');
            //$game->update_time = $lastGame->created_at->addSeconds(90)->setTimezone('Asia/Kolkata');
            
            $game->update_time = Carbon::now()->addSeconds(60)->setTimezone('Asia/Kolkata');
            
            if($game->save())
                return Command::SUCCESS;
            else{
                $this->error('Failed to save the game.');
                return Command::FAILURE;
            }
            
        }

}
