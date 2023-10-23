<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'super_session_id',
        'admitted_at',
        'registration_id',
        'preferred_date',
        'preferred_time'
    ];

    public function masterclass()
    {
        return $this->belongsTo(SuperSession::class, 'super_session_id', 'id');
    }
}
