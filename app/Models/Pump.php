<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pump extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'pumps';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_by',
        'station_id',
        'tank_id',
    ];  

    public function tanks(){
        return $this->belongsToMany(Tank::class);
    } 
    public function pumpTank(){
        return $this->belongsTo(Tank::class,"tank_id");
    }     
    public function hoses(){
        return $this->belongsToMany(Hose::class);
    }              
}
