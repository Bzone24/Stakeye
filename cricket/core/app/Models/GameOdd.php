<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameOdd extends Model
{
    use HasFactory;

    protected $table = 'game_odds'; // Ensure this matches your table name

    protected $primaryKey = 'id';

    protected $fillable = [
        'marketId',
        'type',
        'selectionId',
        'runnerName',
        'status',
        'betDelay',
        'bspReconciled',
        'complete',
        'inplay',
        'numberOfWinners',
        'numberOfActiveRunners',
        'totalMatched',
        'lastPriceTraded',
        'handicap',
        'sortPriority',
        'availableToBack',
        'availableToLay',
    ];

    protected $casts = [
        'availableToBack' => 'array',
        'availableToLay' => 'array',
        'totalMatched' => 'decimal:2',
        'lastPriceTraded' => 'decimal:2',
        'handicap' => 'decimal:2',
        'bspReconciled' => 'boolean',
        'complete' => 'boolean',
        'inplay' => 'boolean',
    ];
}
