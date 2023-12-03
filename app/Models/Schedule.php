<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table      = 'tbl_schedule';
    protected $primaryKey = 'schedule_id';
    Protected $fillable   = [
        'deliver_id', 'hasno', 'bussiness_name', 'delivery_address', 'contact_person', 'contactno', 'delivery_date', 'dispatch_by', 'dispatch_date', 'recieve_by', 'recieve_date'
    ];
}
