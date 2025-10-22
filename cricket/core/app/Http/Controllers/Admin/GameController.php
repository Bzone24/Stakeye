<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\League;
use App\Models\Team;
use App\Models\Category;
use GuzzleHttp\Client;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller {
    protected $pageTitle;

    protected function gameData($scope = null) {

        if ($scope) {
            $games = Game::$scope();
        } else {
            $games = Game::query();
        }

        if (request()->start_time) {
            $games->DateTimeFilter('start_time');
        }

        if (request()->bet_start_time) {
            $games->DateTimeFilter('bet_start_time');
        }

        if (request()->bet_end_time) {
            $games->DateTimeFilter('bet_end_time');
        }

        $games = $games->with(['teamOne', 'teamTwo', 'league.category'])->filter(['league_id', 'team_one_id', 'team_two_id'])
            ->orderBy('id', 'desc')
            ->withCount(['questions'])
            ->paginate(getPaginate());

        $pageTitle = $this->pageTitle;

        $teamsOne = Team::rightJoin('games', 'teams.id', 'games.team_two_id')->select('teams.id', 'teams.name', 'teams.short_name')->distinct('teams.id')->get();
        $teamsTwo = Team::rightJoin('games', 'teams.id', 'games.team_one_id')->select('teams.id', 'teams.name', 'teams.short_name')->distinct('teams.id')->get();

        $teams = $teamsOne->union($teamsTwo)->unique();

        $leagues = League::whereHas('games')->get();

        $categories = Category::orderBy('id', 'desc')->get();

        return view('admin.game.index', compact('pageTitle', 'games', 'leagues', 'teams','categories'));
    }

    public function index() {
        $this->pageTitle = 'All Games';
        return $this->gameData();
    }

    public function running() {
        $this->pageTitle = 'Running Games';
        return $this->gameData('running');
    }

    public function upcoming() {
        $this->pageTitle = 'Upcoming Games';
        return $this->gameData('upcoming');
    }

    public function Ended() {
        $this->pageTitle = 'Ended Games';
        return $this->gameData('expired');
    }

    public function create() {
        $pageTitle = 'Add New Game';
        $leagues   = League::with('category')->orderBy('name')->get();
        return view('admin.game.form', compact('pageTitle', 'leagues'));
    }

    public function teamsByCategory($categoryId) {
        $teams = Team::where('category_id', $categoryId)->orderBy('name')->get();

        if (count($teams)) {
            return response()->json([
                'teams' => $teams,
            ]);
        } else {
            return response()->json([
                'error' => 'No teams found for this league\'s category',
            ]);
        }
    }

    public function edit($id) {
        $game      = Game::findOrFail($id);
        $pageTitle = 'Update Game';
        $leagues   = League::latest()->with('category')->get();
        return view('admin.game.form', compact('game', 'pageTitle', 'leagues'));
    }

    public function store(Request $request, $id = 0) {
        $this->validation($request, $id);
        $league = League::findOrFail($request->league_id);

        if ($id) {
            $game         = Game::findOrFail($id);
            $notification = 'Game updated successfully';
        } else {
            $game         = new Game();
            $notification = 'Game added successfully';
        }

        $game->team_one_id    = $request->team_one_id;
        $game->team_two_id    = $request->team_two_id;
        $game->slug           = $request->slug;
        $game->league_id      = $league->id;
        $game->start_time     = Carbon::parse($request->start_time);
        $game->bet_start_time = Carbon::parse($request->bet_start_time);
        $game->bet_end_time   = Carbon::parse($request->bet_end_time);
        $game->save();

        $notify[] = ['success', $notification];

        if ($id) {
            return back()->withNotify($notify);
        }

        return to_route('admin.question.index', $game->id)->withNotify($notify);
    }

    public function updateStatus($id) {
        return Game::changeStatus($id);
    }

    protected function validation($request, $id) {
        $request->validate([
            'league_id'      => 'required|integer|gt:0',
            'team_one_id'    => 'required|integer|gt:0',
            'team_two_id'    => 'required|integer|gt:0|different:team_one_id',
            'slug'           => 'required|alpha_dash|max:255|unique:games,slug,' . $id,
            'start_time'     => 'required|date',
            'bet_start_time' => 'required|date',
            'bet_end_time'   => 'required|date|after:bet_start_time',
        ], [
            'slug.alpha_dash'    => 'Only alpha numeric value. No space or special character is allowed',
            'bet_end_time.after' => 'Bet end time should be after the bet start time',
        ]);
    }

    public function fetchLiveGame(Request $request)
    {
        $categoryId = $request->input('category_id');
        $status = $request->input('status');
        $endpoint = $status === 'live' ? 'inplay' : 'upcoming';
        $apiUrl = 'https://api.b365api.com/v1/betfair/sb/' . $endpoint . '?sport_id=' . $categoryId . '&token=215719-Vwi71YEzXvkgEj';

        $client = new Client(['verify' => false, 'timeout' => 30]);

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            if ($data['success'] == 1) {
                DB::beginTransaction();

                try {
                    foreach ($data['results'] as $result) {
                        $homeTeam = Team::find($result['home']['id']);
                        $awayTeam = Team::find($result['away']['id']);
                        $league = League::find($result['league']['id']);
            
                        if ($homeTeam && $awayTeam && $league) {
                            Game::updateOrCreate(
                                ['our_event_id' => $result['id']],
                                [
                                    'category_id' => $result['sport_id'],
                                    'team_one_id' => $homeTeam->id,
                                    'team_two_id' => $awayTeam->id,
                                    'league_id' => $league->id,
                                    'slug' => strtolower(str_replace(' ', '-', $homeTeam->name . '-vs-' . $awayTeam->name)),
                                    'start_time' => date('Y-m-d H:i:s', $result['time']),
                                    'bet_start_time' => $result['time_status'] == 0
                                    ? now()
                                    : now(),
                                'bet_end_time' => $result['time_status'] == 0
                                    ? date('Y-m-d H:i:s', $result['time'])
                                    : now()->endOfDay(),
                                    'status' => 1
                                ]
                            );
                        }
                    }

                    DB::commit();

                    return response()->json(['status' => 'success', 'message' => 'Data updated successfullyss']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
                }
            }

            return response()->json(['status' => 'error', 'message' => 'Failed to fetch data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function fetchGameMarket_old(Request $request)
    {
        $categoryId = $request->input('sport_id');
        $client = new Client();

        try {
            $games = Game::where([
                'category_id' => $categoryId,
                'status' => 1
            ])->get(['id', 'our_event_id']);

            DB::beginTransaction();

            foreach ($games as $game) {
                $response = $client->get('https://api.b365api.com/v1/betfair/sb/event', [
                    'query' => [
                        'token' => '215719-Vwi71YEzXvkgEj',
                        'event_id' => $game->our_event_id
                    ]
                ]);

                $data = json_decode($response->getBody()->getContents(), true);

                if ($data['success'] != 1) {
                    continue;
                }

                foreach ($data['results'] as $result) {
                    if (!isset($result['markets']) || empty($result['markets'])) {
                        continue;
                    }

                    $markets = $result['markets'];

                    foreach ($markets as $market) {
                        $question = Question::updateOrCreate(
                            [
                                'game_id' => $game->id,
                                'title' => $market['market']['marketName'] ?? 'Unknown'
                            ],
                            [
                                'status' => 1,
                                'locked' => 0,
                                'result' => 0,
                                'refund' => 0,
                                'win_option_id' => 0,
                                'amount_refunded' => 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        );

                        $runnerMap = [];
                        if (isset($market['market']['runners']) && !empty($market['market']['runners'])) {
                            foreach ($market['market']['runners'] as $runner) {
                                $runnerMap[$runner['selectionId']] = $runner['runnerName'];
                                $runnerMap[$runner['handicap']] = $runner['handicap'];
                            }
                        }

                        if (isset($market['runnerDetails']) && !empty($market['runnerDetails'])) {
                            foreach ($market['runnerDetails'] as $runner) {
                                $selectionId = $runner['selectionId'];
                                $handicap = $runner['handicap'];
                                $odds = $runner['runnerOdds']['decimalDisplayOdds']['decimalOdds'] ?? 0;

                                Option::updateOrCreate(
                                    [
                                        'question_id' => $question->id,
                                        'name' => isset($runnerMap[$selectionId]) 
                                        ? ($handicap > 0 
                                            ? $runnerMap[$selectionId] . '-' . $handicap 
                                            : $runnerMap[$selectionId]) 
                                        : 'Unknown',
                                    ],
                                    [
                                        'odds' => $odds,
                                        'status' => $runner['runnerStatus'] === 'ACTIVE' ? 1 : 0,
                                        'locked' => 0,
                                        'winner' => isset($runner['result']['type']) && $runner['result']['type'] === 'HOME' ? 1 : 0,
                                        'created_at' => now(),
                                        'updated_at' => now()
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Market data saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() . ' at line ' . $e->getLine()
            ]);
        }
    }

    public function fetchGameMarket(Request $request)
    {
        $categoryId = $request->input('sport_id');
        $client = new Client();

        try {
            $games = Game::where([
                'category_id' => $categoryId,
                'status' => 1
            ])->get(['id', 'our_event_id']);

            DB::beginTransaction();

            foreach ($games as $game) {
                $response = $client->get('https://api.b365api.com/v1/betfair/sb/event', [
                    'query' => [
                        'token' => '215719-Vwi71YEzXvkgEj',
                        'event_id' => $game->our_event_id
                    ]
                ]);

                $data = json_decode($response->getBody()->getContents(), true);

                if ($data['success'] != 1) {
                    continue;
                }

                foreach ($data['results'] as $result) {
                    if (!isset($result['markets']) || empty($result['markets'])) {
                        continue;
                    }

                    $markets = $result['markets'];

                    foreach ($markets as $market) {
                        $marketType = $market['market']['marketType'] ?? 'Unknown'; // Get Market Type

                        $question = Question::updateOrCreate(
                            [
                                'game_id' => $game->id,
                                'title' => $market['market']['marketName'] ?? 'Unknown'
                            ],
                            [
                                'market_type' => $marketType, // Save Market Type
                                'status' => 1,
                                'locked' => 0,
                                'result' => 0,
                                'refund' => 0,
                                'win_option_id' => 0,
                                'amount_refunded' => 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        );

                        $runnerMap = [];
                        if (isset($market['market']['runners']) && !empty($market['market']['runners'])) {
                            foreach ($market['market']['runners'] as $runner) {
                                $runnerMap[$runner['selectionId']] = $runner['runnerName'];
                                $runnerMap['handicap_' . $runner['selectionId']] = $runner['handicap'] ?? null; // Store handicap separately
                            }
                        }

                        if (isset($market['runnerDetails']) && !empty($market['runnerDetails'])) {
                            foreach ($market['runnerDetails'] as $runner) {
                                $selectionId = $runner['selectionId'];
                                $handicap = $runner['handicap'] ?? $runnerMap['handicap_' . $selectionId] ?? null;
                                $odds = $runner['runnerOdds']['decimalDisplayOdds']['decimalOdds'] ?? 0;

                                Option::updateOrCreate(
                                    [
                                        'question_id' => $question->id,
                                        'name' => isset($runnerMap[$selectionId])
                                            ? ($handicap > 0
                                                ? $runnerMap[$selectionId] . '-' . $handicap
                                                : $runnerMap[$selectionId])
                                            : 'Unknown',
                                    ],
                                    [
                                        'odds' => $odds,
                                        'status' => $runner['runnerStatus'] === 'ACTIVE' ? 1 : 0,
                                        'locked' => 0,
                                        'winner' => isset($runner['result']['type']) && $runner['result']['type'] === 'HOME' ? 1 : 0,
                                        'created_at' => now(),
                                        'updated_at' => now()
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Market data saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() . ' at line ' . $e->getLine()
            ]);
        }
    }

}
