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
        'job_function',
        'gender',
        'have_an_account',
        'account_number',
        'industry_type',
        'area_of_responsibility',
        'interests'
    ];

    protected $casts = [
        'interests' => 'array'
    ];
}
