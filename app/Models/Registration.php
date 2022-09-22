<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
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
}
