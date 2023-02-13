<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reading extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'readings';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'employee_id',
        'created_by',      
        'station_id',
        'hose_id',
        'pump_id',
        'tank_id',
        'hose_val',
        'litre',

        
    ];    

    public function users(){
        return $this->belongsTo(User::class,'employee_id');
    } 
    public function tanks(){
        return $this->belongsTo(Tank::class,"tank_id");
    }     
    public function pumps(){
        return $this->belongsTo(Pump::class,"pump_id");
    }            
    public function hoses(){
        return $this->belongsTo(Hose::class,"hose_id");
    }       
}
