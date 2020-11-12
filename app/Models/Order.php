<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'deadline',
        'installation',
        'notes',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function orderDetails () {
        return $this->hasMany(OrderDetail::class);
    }

    function customer () {
        return $this->belongsTo(Customer::class);
    }

    function getOrdersByDeadline ($date) {
	    return Self::whereDate('deadline', $date)->get();
    }
}
