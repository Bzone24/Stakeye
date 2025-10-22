<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $table = 'game_session'; // Specify table name if different from Laravel convention

    protected $primaryKey = 'id'; // Primary key

    public $timestamps = true; // Enable timestamps

    protected $fillable = [
        'SelectionId',
        'RunnerName',
        'ballsess',
        'gtype',
        'GameStatus',
        'gtstatus',
        'max',
        'min',
        'rem',
        'srno',
        'mname',
        'BackPrice1',
        'BackPrice2',
        'BackPrice3',
        'BackSize1',
        'BackSize2',
        'BackSize3',
        'LayPrice1',
        'LayPrice2',
        'LayPrice3',
        'LaySize1',
        'LaySize2',
        'LaySize3',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
