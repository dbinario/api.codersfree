<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::included()
        ->filter()
        ->sort()
        ->getOrPaginate();

        return PostResource::collection($posts);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        
        //con esto creamos el slug de manera automatica
        $request->request->add(['slug'=>Str::slug($request->input('name'))]);

        $request->validate([

            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts',
            'extract' => 'required',
            'body' => 'required',
            //verificamos que existe el id en la categoria
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            
        ]);

        //creamos el registro de categoria
        $post=Post::create($request->all());

        return PostResource::make($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          //buscamos el post  por id
          $post=Post::included()->findOrFail($id);

          // en caso de encontrar la categoria la regresamos
           return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //

          //con esto creamos el slug de manera automatica
        $request->request->add(['slug'=>Str::slug($request->input('name'))]);

        $request->validate([

            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,'.$post->id,
            'extract' => 'required',
            'body' => 'required',
            //verificamos que existe el id en la categoria
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            
        ]);

        $post->update($request->all());

        return PostResource::make($post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //eliminamos el post y regresamos la peticion
        $post->delete();
        return PostResource::make($post);
    }
}
