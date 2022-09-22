<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'qrcode_url',
        'token',
        'date_used'
    ];

    public function class_reg()
    {
        return $this->hasMany(ClassRegistration::class, 'registration_id', 'registration_id');
    }
}
