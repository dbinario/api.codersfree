<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   

        //elimino la carpeta
        Storage::deleteDirectory('posts');

        //creo la carpeta
        Storage::makeDirectory('posts');

        //mandamos a llamar al seeder de usuarios
        $this->call(UserSeeder::class);

        Category::factory(4)->create();
        Tag::factory(8)->create();

        $this->call(PostSeeder::class);


    }
}
