<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;


class Category extends Model
{
    use HasFactory,ApiTrait;

    //que campos se van a usar para asignacion masiva
    protected $fillable = ['name', 'slug'];

    //aplicamos los filtros
    protected $allowIncluded=['posts','posts.user'];
    protected $allowFilter=['id','name','slug'];
    protected $allowSort=['id','name','slug'];

    //relacion uno a muchos

    public function posts()
    {
        return $this->hasMany(Post::class);
    }



}
