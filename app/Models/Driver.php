<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table      = 'tbl_driver';
    protected $primaryKey = 'driver_id';
    Protected $fillable   = [
        'driver_name', 'age', 'driver_address', 'driver_phone', 'license_no','status', 'driver_add_date',
    ];
}
