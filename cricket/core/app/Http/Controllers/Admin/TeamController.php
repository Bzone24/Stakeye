<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Team;
use App\Models\GameMatch;
use App\Models\GameTournament;
use Illuminate\Support\Facades\DB;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TeamController extends Controller {
    public function list() {
        $pageTitle  = 'All Teams';
        $teams      = Team::searchable(['name', 'slug', 'category:name'])->latest()->with('category')->paginate(getPaginate());
        $categories = Category::latest()->get();
        return view('admin.team', compact('pageTitle', 'teams', 'categories'));
    }

    public function index() {
        $pageTitle  = 'All Match';
        $matches = GameMatch::searchable(['name','tournament:name'])->with('tournament')->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::latest()->get();
        $tournaments = GameTournament::latest()->get();
        return view('admin.match', compact('pageTitle','categories','matches','tournaments'));
    }

    public function store(Request $request, $id = 0) {

        $this->validation($request, $id);

        if ($id) {
            $team         = Team::findOrFail($id);
            $notification = 'Team updated successfully';
        } else {
            $team         = new Team();
            $notification = 'Team added successfully';
        }
        if ($request->hasFile('image')) {
            $fileName    = fileUploader($request->image, getFilePath('team'), getFileSize('team'), @$team->image);
            $team->image = $fileName;
        }

        $team->category_id = $request->category_id;
        $team->name        = $request->name;
        $team->short_name  = $request->short_name;
        $team->slug        = strtolower($request->slug);
        $team->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    protected function validation($request, $id) {
        $imageValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|max:255',
            'short_name'  => 'required|max:40',
            'slug'        => 'required|alpha_dash|max:255|unique:teams,slug,' . $id,
            'image'       => [$imageValidation, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ], [
            'slug.alpha_dash' => 'Only alpha numeric value. No space or special character is allowed',
        ]);
    }

    public function save(Request $request, $id = 0) {

        $this->validation($request, $id);

        if ($id) {
            $team         = GameMatch::findOrFail($id);
            $notification = 'Match updated successfully';
        } else {
            $team         = new GameMatch();
            $notification = 'Match added successfully';
        }

        $team->competitionId = $request->competition_id;
        $team->name        = $request->name;
        $team->openDate  = $request->openDate;
        $team->marketCount        = strtolower($request->marketCount);
        $team->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }


    protected function validateRequest($request, $id) {
        $imageValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|max:255',
            'short_name'  => 'required|max:40',
            'slug'        => 'required|alpha_dash|max:255|unique:teams,slug,' . $id,
            'image'       => [$imageValidation, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ], [
            'slug.alpha_dash' => 'Only alpha numeric value. No space or special character is allowed',
        ]);
    }

    public function fetchTeam(Request $request)
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
                        $homeTeam = $result['home'];
                        Team::updateOrCreate(
                            ['id' => $homeTeam['id']],
                            [
                                'category_id' => $result['sport_id'],
                                'name' => $homeTeam['name'],
                                'short_name' => substr($homeTeam['name'], 0, 40),
                                'slug' => strtolower(str_replace(' ', '-', $homeTeam['name']))
                            ]
                        );
            
                        $awayTeam = $result['away'];
                        Team::updateOrCreate(
                            ['id' => $awayTeam['id']],
                            [
                                'category_id' => $result['sport_id'],
                                'name' => $awayTeam['name'],
                                'short_name' => substr($awayTeam['name'], 0, 40),
                                'slug' => strtolower(str_replace(' ', '-', $awayTeam['name']))
                            ]
                        );
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
