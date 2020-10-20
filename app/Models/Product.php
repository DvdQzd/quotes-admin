<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'base_price',
        'product_type_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function orderDetails () {
        return $this->hasMany(OrderDetail::class);
    }

    function productType () {
        return $this->belongsTo(ProductType::class);
    }

    function searchAutoComplete ($searchText) {
      return Self::select('id', 'products.name')
	->where('name', 'like', "%{$searchText}%")
	->get();
    } 
}
