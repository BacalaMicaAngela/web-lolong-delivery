<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table      = 'tbl_billing';
    protected $primaryKey = 'billing_id';
    Protected $fillable   = [
        'billing_id', 'billing_name ', 'billing_file'
    ];
}
