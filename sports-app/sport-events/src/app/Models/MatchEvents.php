<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchEvents extends Model
{
    protected $table = 'matches';
    
    use HasFactory;

    protected $fillable = [
        'home_team_name',
        'home_team_image',
        'away_team_name',
        'away_team_image',
        'home_team_goals',
        'away_team_goals',
        'match_date',
    ];
}
