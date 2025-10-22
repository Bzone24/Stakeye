<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class League extends Model {
    use GlobalStatus;

    protected $fillable = [
        'id', // Add this line
        'name',
        'short_name',
        'slug',
        'category_id',
        'status',
        'image',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function games() {
        return $this->hasMany(Game::class);
    }

    public function runningGame() {
        return $this->hasMany(Game::class)->where('bet_end_time', '>', now())->where('bet_start_time', '<', now());
    }
    public function upcomingGame() {
        return $this->hasMany(Game::class)->where('bet_start_time', '>', now());
    }

}
