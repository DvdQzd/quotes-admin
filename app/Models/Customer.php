<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lastName',
        'documentId',
        'address'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function phones () {
        return $this->hasMany(Phone::class);
    }

    function emails () {
        return $this->hasMany(Email::class);
    }

    function orders () {
        return $this->hasMany(Order::class);
    }

    function search ($searchText) {
        return Self::whereRaw(
            "LOWER(CONCAT(customers.name, ' ',customers.\"lastName\")) LIKE ?",
            ["%{$searchText}%"])
            ->orWhere('documentId', 'like', "%{$searchText}%")
            ->paginate(15);
    }
}
