<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'registration_id',
        'qrcode_url',
        'token',
        'date_used'
    ];

    public function reg_info()
    {
        return $this->hasOne(Registration::class, 'id', 'registration_id');
    }
}
