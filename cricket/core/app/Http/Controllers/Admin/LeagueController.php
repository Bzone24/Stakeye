<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\League;
use App\Models\GameTournament;
use App\Rules\FileTypeValidate;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeagueController extends Controller {
    public function list() {
        $pageTitle  = 'All Leagues';
        $leagues    = League::searchable(['name', 'slug', 'category:name'])->with('category')->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.league', compact('pageTitle', 'leagues', 'categories'));
    }

    public function index() {
        $pageTitle  = 'All Tournaments';
        $leagues    = League::searchable(['name', 'slug', 'category:name'])->with('category')->orderBy('id', 'desc')->paginate(getPaginate());
        $tournaments = GameTournament::searchable(['name','slug','sport:name'])->with('sport')->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.tournament', compact('pageTitle', 'leagues', 'categories','tournaments'));
    }

    public function store(Request $request, $id = 0) {

        $this->validation($request, $id);

        if ($id) {
            $league       = League::findOrFail($id);
            $notification = 'League updated successfully';
        } else {
            $league       = new League();
            $notification = 'League added successfully';
        }

        if ($request->hasFile('image')) {
            $fileName      = fileUploader($request->image, getFilePath('league'), getFileSize('league'), @$league->image);
            $league->image = $fileName;
        }

        $league->category_id = $request->category_id;
        $league->name        = $request->name;
        $league->short_name  = $request->short_name;
        $league->slug        = strtolower($request->slug);
        $league->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return League::changeStatus($id);
    }

    protected function validation($request, $id) {
        $imageValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|max:40',
            'short_name'  => 'required|max:40',
            'slug'        => 'required|alpha_dash|max:255|unique:leagues,slug,' . $id,
            'image'       => [$imageValidation, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ], [
            'slug.alpha_dash' => 'Only alpha numeric value. No space or special character is allowed',
        ]);
    }

    public function flag($id) {
        return GameTournament::changeStatus($id);
    }

    public function save(Request $request, $id = 0) {

        $this->validation($request, $id);

        if ($id) {
            $tournament  = GameTournament::findOrFail($id);
            $notification = 'Tournament updated successfully';
        } else {
            $tournament = new GameTournament();
            $notification = 'Tournament added successfully';
        }

        if ($request->hasFile('image')) {
            $fileName      = fileUploader($request->image, getFilePath('league'), getFileSize('league'), @$league->image);
            $tournament->image = $fileName;
        }
        $id = $request->category_id;
        $categories = Category::find($id);
        $tournament->competition_id = mt_rand(10000000, 99999999);
        $tournament->category_id = $categories->id;
        $tournament->sport_id = $categories->sports_id;
        $tournament->name        = $request->name;
        $tournament->short_name  = $request->short_name;
        $tournament->marketCount  = $request->marketCount;
        $tournament->competitionRegion  = $request->competitionRegion;
        $tournament->slug        = strtolower($request->slug);
        $tournament->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }


    public function fetchLeague(Request $request)
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
                        if (isset($result['league'])) { 
                            $league = $result['league'];
                
                            League::updateOrCreate(
                                ['id' => $league['id']],
                                [
                                    'category_id' => $result['sport_id'],
                                    'name' => $league['name'],
                                    'short_name' => substr($league['name'], 0, 40),
                                    'slug' => strtolower(str_replace(' ', '-', $league['name'])),
                                    'status' => 1
                                ]
                            );
                        }
                    }

                    DB::commit();

                    return response()->json(['status' => 'success', 'message' => 'Data updated successfully']);
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

}
