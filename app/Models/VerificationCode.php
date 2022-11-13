<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
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
        'registration_id',
        'qrcode_url',
        'token',
        'date_used'
    ];

    protected $casts = [
        'reg_uuid' => 'string'
    ];

    public function reg_info()
    {
        return $this->hasOne(Registration::class, 'reg_uuid', 'reg_uuid');
    }
}
