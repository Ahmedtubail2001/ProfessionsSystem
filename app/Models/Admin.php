<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $fillable = ['name', 'email', 'password', 'role_name'];
    public const type_admin = [
        'hight level admin' => "hight level admin",
        'normal admin' => "normal admin"
    ];
}
