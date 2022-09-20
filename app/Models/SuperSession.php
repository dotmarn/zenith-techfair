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
        'max_participants'
    ];

    public function registrations()
    {
        return $this->hasMany(ClassRegistration::class, 'super_session_id', 'id');
    }
}
