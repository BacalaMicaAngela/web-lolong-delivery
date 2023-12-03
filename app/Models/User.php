<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;

    protected $table='users';
    protected $primaryKey = 'user_id';
    Protected $fillable   = [
        'u_name', 'username', 'userType', 'password', 'user_avatar', 'status'
    ];
}
