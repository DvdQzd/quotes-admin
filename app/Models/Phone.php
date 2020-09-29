<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'value'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function customer () {
        return $this->belongsTo('App/Models/Customer');
    }
}
