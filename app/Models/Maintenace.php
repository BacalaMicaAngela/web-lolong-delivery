<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenace extends Model
{
    use HasFactory;

    protected $table      = 'tbl_maintenace';
    protected $primaryKey = 'maintenace_id';
    Protected $fillable   = [
        'driver_id', 'truck_id', 'driver_phone', 'reciept_proof', 'source_type'
    ];
}
