<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'insatgram',
            'facebook',
            'telegram',
            'linkedin',
            'twitter',
            'whatasapp_no',
            'upi_id',
            'wallet_bonus',
    ];
}
