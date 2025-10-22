<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {
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

    public function teamImage() {
        if (!empty($this->image)) {
            $imagePath = getImage(getFilePath('team') . '/' . $this->image, getFileSize('team'));
            if ($imagePath) {
                return $imagePath;
            }
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=fc6404&color=fff';
    }
}
