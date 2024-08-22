<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_name',
        'destination_name',
        'origin_lat',
        'origin_lng',
        'destination_lat',
        'destination_lng'
    ];
}
