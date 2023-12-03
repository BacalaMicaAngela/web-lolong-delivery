<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;

    protected $table      = 'tbl_deleted_user';
    protected $fillable = ['u_name', 'username'];
    
}

