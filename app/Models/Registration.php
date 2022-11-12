<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'middlename',
        'email',
        'phone',
        'role',
        'sector',
        'have_an_account',
        'account_number',
        'interests',
        'social_media',
        'reason'
    ];

    protected $casts = [
        'interests' => 'array',
        'social_media' => 'array'
    ];

    public function super_session()
    {
        return $this->hasMany(ClassRegistration::class, 'registration_id', 'id');
    }

    public function tokens()
    {
        return $this->hasOne(VerificationCode::class, 'registration_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'registration_id', 'id');
    }
}
