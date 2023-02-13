<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'shifts';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_by',
        'employee_id',
        'time_in',
        'time_out',
        'station_id',
    ];  

    public function user(){
        return $this->belongsTo(User::class,'employee_id');
    }       
}
