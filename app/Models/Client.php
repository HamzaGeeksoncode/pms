<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'clients';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'station_id',
        'name',
        'company_name',
        'pay_type',
        'contact_number_1',
        'contact_number_2',
        'petrol_limit',
        'diesel_limit',
        'petrol_discount',
        'diesel_discount',
        'petrol_quan',
        'diesel_quan',
        'remaining_petrol_quan',
        'remaining_diesel_quan',
    ];  
}
