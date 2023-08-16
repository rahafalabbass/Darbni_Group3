<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function favorite(){
        return $this->belongsTo(Favorite::class);
    }
}
