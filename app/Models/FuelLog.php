<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    
    public $table = 'fuel_logs';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'price',
        'type',
        'station_id',
        'created_by',
        'fuel_id',
        'price_change_date',
    ];     
}
