<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nic',
        'contact_no',
        'reserve_date',
        'travel_date',
        'start_location',
        'end_location',
        'vehicle_no',
        'seat_no',
        'status',
        'created_at',
    ];
}
