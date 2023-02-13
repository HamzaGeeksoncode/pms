<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsPayment extends Model
{
    use SoftDeletes,HasFactory;
    public $table = 'fuel';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'attachment',
    ];
    public function clientsPayments(){
        return $this->belongsTo(Client::class,  'id');
    }    
}
