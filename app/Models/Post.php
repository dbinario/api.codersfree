<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Post extends Model
{
    use HasFactory,ApiTrait;

    //se definen las constantes
    const BORRADOR  = 1;
    const PUBLICADO = 2;


    protected $fillable = [
        'name',
        'slug',
        'extract',
        'body',
        'category_id',
        'user_id'
    ];

    //relacion uno a muchos con el modelo User

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion uno a muchos con el modelo category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    //relacion uno a muchos con el modelo Tag

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //relacion uno a muchos con el modelo Image

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
