<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    use HasFactory;

    protected $table      = 'tbl_delivery';
    protected $primaryKey = 'deliver_id';
    Protected $fillable   = [
        'truck_id', 'driver_id ', 'helper', 'deliver_status'
    ];
}
