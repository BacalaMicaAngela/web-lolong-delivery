<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trucks extends Model
{
    use HasFactory;

    protected $table      = 'tbl_truck_units';
    protected $primaryKey = 'truck_id';
    Protected $fillable   = [
        'truck_name', 'truck_plateno', 'model', 'chasisno'
    ];
}
