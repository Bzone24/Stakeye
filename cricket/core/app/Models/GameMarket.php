<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GameMarket extends Model
{
    use HasFactory;

    protected $table = 'game_markets'; // Explicitly define the table name

    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'marketId',
        'eventId',
        'marketName',
        'marketType',
        'marketStatus',
        'marketStartTime',
        'totalMatched',
        'runners_details'
    ];

    protected $casts = [
        'marketStartTime' => 'datetime',
        'totalMatched' => 'integer',
        'runners_details' => 'json',
    ];

    public function getIsRunningAttribute()
    {
        return Carbon::now()->greaterThanOrEqualTo($this->marketStartTime);
    }

    public function match()
    {
        return $this->belongsTo(GameMatch::class, 'eventId', 'eventId');
    }
}
