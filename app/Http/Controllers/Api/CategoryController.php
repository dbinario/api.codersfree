<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//importamos el recurso
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::included()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();

        return CategoryResource::collection($categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //con esto creamos el slug de manera automatica
        $request->request->add(['slug'=>Str::slug($request->input('name'))]);

        $request->validate([

            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories',
            
        ]);

        //creamos el registro de categoria
        $category=Category::create($request->all());

        return CategoryResource::make($category);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //buscamos la categoria por id
        $category=Category::included()->findOrFail($id);

        // en caso de encontrar la categoria la regresamos
         return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
           //con esto creamos el slug de manera automatica
           $request->request->add(['slug'=>Str::slug($request->input('name'))]);

           $request->validate([
   
               'name' => 'required|max:255',
               'slug' => 'required|max:255|unique:categories,slug,'.$category->id
               
           ]);
   
           //actualizamos la categoria
           $category->update($request->all());
   
           //return response()->json($category,201);
           return CategoryResource::make($category);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //eliiminamos la categoria
        $category->delete();

        return CategoryResource::make($category);
    }
}
