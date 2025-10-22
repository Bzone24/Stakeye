<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GameMatch extends Model
{
    use HasFactory;

    protected $table = 'game_matches';

    protected $primaryKey = 'id'; 

    public $timestamps = true; 

    protected $fillable = [
        'eventId',
        'competitionId',
        'name',
        'timezone',
        'openDate',
        'marketCount',
        'status',
        'is_unlock'
    ];

    protected $casts = [
        'openDate' => 'datetime',
        'status' => 'boolean',
        'is_unlock' => 'boolean',
    ];

    public function getTeam1Attribute()
    {
        return explode(' v ', $this->name)[0] ?? null;
    }

    public function getTeam2Attribute()
    {
        return explode(' v ', $this->name)[1] ?? null;
    }

    public function getIsRunningAttribute()
    {
        return Carbon::now()->greaterThanOrEqualTo(Carbon::parse($this->openDate));
    }

     // Define inverse relationship
     public function tournament()
     {
         return $this->belongsTo(GameTournament::class, 'competitionId', 'competition_id');
     }

     public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function markets()
    {
        return $this->hasMany(GameMarket::class, 'eventId', 'eventId');
    }

}
