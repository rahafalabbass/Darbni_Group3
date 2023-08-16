<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function materials(){
        return $this->hasMany(Material::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
