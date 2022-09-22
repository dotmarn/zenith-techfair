<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'max_participants',
        'event_date',
        'event_time'
    ];

    protected $casts = [
        'event_date' => 'array',
        'event_time' => 'array'
    ];

    public function registrations()
    {
        return $this->hasMany(ClassRegistration::class, 'super_session_id', 'id');
    }
}
