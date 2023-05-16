<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function directions()
    {
        return $this->belongsToMany(Direction::class);
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
