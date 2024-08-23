<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'who',
        'name',
        'surname',
        'organization',
        'phone',
        'email',
        'avatar',
        'notes',
        'social_links',
        // Админ переменные
        'admin_table',
        'admin_table_projects',
    ];

    protected $hidden = [

        'remember_token',
    ];

    protected $casts = [

        'social_links' => 'array',
    ];
}
