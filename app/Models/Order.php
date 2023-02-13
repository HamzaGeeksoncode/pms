<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'created_by',
        'shift_id',
        'station_id',
        'date',
        'petrol_discount',
        'petrol_quan',
        'petrol_total',
        'petrol_after_discount',
        'petrol_limit',
        'petrol_discount_val',
        'diesel_discount',
        'diesel_quan',
        'diesel_total',
        'diesel_after_discount',
        'diesel_limit',
        'diesel_discount_val',        
    ];  

    public function clients(){
        return $this->belongsTo(Client::class,'client_id');
    }    
}
