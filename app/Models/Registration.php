<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $primaryKey = 'reg_uuid';

    protected $keyType = 'string';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'reg_uuid',
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
        'social_media' => 'array',
        'reg_uuid' => 'string'
    ];

    public function super_session()
    {
        return $this->hasMany(ClassRegistration::class, 'reg_uuid', 'reg_uuid');
    }

    public function tokens()
    {
        return $this->hasOne(VerificationCode::class, 'reg_uuid', 'reg_uuid');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'reg_uuid', 'reg_uuid');
    }
}
