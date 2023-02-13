<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hose extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'hoses';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_by',
        'station_id',
        'pump_id',
    ];  

    public function pumps(){
        return $this->belongsToMany(Pump::class);
    }
    public function Hosepump(){
        return $this->belongsTo(Pump::class,"pump_id");
    }                  
}
