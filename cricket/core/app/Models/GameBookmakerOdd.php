<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBookmakerOdd extends Model
{
    use HasFactory;

    protected $table = 'game_bookmaker_odds';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'market_id',
        'market_name',
        'rem',
        'active',
        'inplay',
        'selection_id',
        'runner_name',
        'runner_status',
        'handicap',
        'sort_priority',
        'available_to_back',
        'available_to_lay',
    ];

    protected $casts = [
        'available_to_back' => 'array',
        'available_to_lay' => 'array',
        'handicap' => 'decimal:2',
        'active' => 'boolean',
        'inplay' => 'boolean',
    ];
}
