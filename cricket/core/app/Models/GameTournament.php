<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Constants\Status;

class GameTournament extends Model
{
    use HasFactory, GlobalStatus;

    protected $table = 'game_tournaments';

    protected $fillable = [
        'competition_id',
        'category_id',
        'sport_id',
        'name',
        'slug', 
        'image',
        'status',
        'marketCount',
        'competitionRegion',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sport()
    {
        return $this->belongsTo(Category::class, 'sport_id', 'sports_id');
    }

    // Define one-to-many relationship
    public function matches()
    {
        return $this->hasMany(GameMatch::class, 'competitionId', 'competition_id');
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'sport_name' => $this->sport ? $this->sport->name : null,
        ];
    }

    public function runningGame()
    {
        return $this->hasMany(GameMatch::class, 'competitionId', 'competition_id')->where('status', Status::ENABLE); // Adjust based on actual status column
    }

}
