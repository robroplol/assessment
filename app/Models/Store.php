<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
