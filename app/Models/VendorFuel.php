<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorFuel extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'vendor_fuel';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'petrol_quantity',
        'diesel_quantity',
        'attachment',
        'serial_no',
        'vendor_id',
        'user_id',
        'station_id',
        'price',
        'petrol_tank_id',
        'diesel_tank_id',
    ];     

    public function vendors(){
        return $this->belongsTo(Vendor::class,  'vendor_id');
    } 
    public function users(){
        return $this->belongsTo(User::class,  'user_id');
    }   
    public function petrolTank(){
        return $this->belongsTo(Tank::class,  'petrol_tank_id');
    } 
    public function dieselTank(){
        return $this->belongsTo(Tank::class,  'diesel_tank_id');
    }               
}
