<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tank extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'tanks';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'capacity',
        'type',
        'created_by',
        'station_id',
    ];  

    public function stations(){
        return $this->belongsToMany(PetrolStation::class);
    }      
    public function pumps(){
        return $this->belongsToMany(Pump::class);
    }    
}
