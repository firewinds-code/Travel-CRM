<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelDetails extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'travel_details';

    protected $fillable = [
        'vehicle',
        'departure_city',
        'destination_city',
        'reservation_date_time',
        'reason',
        'process',
        'accomodation',
        'days_required',
        'advance_required',
        'amount',
    ]; 
}