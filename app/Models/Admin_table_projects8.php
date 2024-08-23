<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin_table_projects8 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admin_table_projects8'; // имя таблицы с id админа в конце

    protected $fillable = [
        'id',  // id проекта
        'role', // Кто работает над проектом (через запятую id - админа)
        'who',  // Чей проект (id админа)
        'name', // Наименование проекта
        'organization', // Организация
        'phone', // Номер клиента проекта
        'email', // Почта клиента проекта
        'admin_table_nametaps', // Имя таблицы к которой привязывается наименование этапов
        'admin_table_projects_quest', // Имя таблицы к которой привязывается задачи этого проекта
        'created_at',
        'updated_at',
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