<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 👈 cái này mới chuẩn
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // 👈 kế thừa Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id', // nếu bạn có multi-branch
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
