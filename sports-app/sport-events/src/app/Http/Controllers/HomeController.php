<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\MatchEvents;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $client = new Client();
        $response = $client->get('https://www.legaseriea.it/api/match?extra_link&order=oldest&lang=en&season_id=157617&match_day_id=157731');
        $matches = json_decode($response->getBody(), true);
        foreach ($matches['data'] as $matchData) {
            $matchDate = Carbon::parse($matchData['match_hm'])->format('Y-m-d H:i:s');

            MatchEvents::updateOrCreate(
                [
                    'home_team_name' => $matchData['home_team']['name'],
                    'away_team_name' => $matchData['away_team']['name'],
                    'match_date' => $matchDate,
                ],
                [
                    'home_team_image' => $matchData['home_team']['logo'] ?? null,
                    'away_team_image' => $matchData['away_team']['logo'] ?? null,
                    'home_team_goals' => $matchData['home_goal'] ?? null,
                    'away_team_goals' => $matchData['away_goal'] ?? null,
                ]
            );
        }

        $allMatches = MatchEvents::all();

        return view('events', ['matches' => $allMatches]);
    }
}
