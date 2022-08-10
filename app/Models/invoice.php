<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = [
        'tgl_invoice',
        'id_customer',
        'total',
        'status'
    ];
}
