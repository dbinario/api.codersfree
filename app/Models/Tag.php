<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Tag extends Model
{
    use HasFactory,ApiTrait;

     //relacion muchos a muchos con el modelo Post

     public function posts()
     {
         return $this->belongsToMany(Post::class);
     }

     
}
