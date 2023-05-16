<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class)->withPivot('value');
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
