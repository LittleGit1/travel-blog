<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'public_path'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
