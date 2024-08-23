<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin4 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admin4';

    protected $fillable = [
        'role',
        'who',
        'name',
        'surname',
        'organization',
        'phone',
        'email',
        'password',
        'social_links',
        'admin_table',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'social_links' => 'array',
    ];
}