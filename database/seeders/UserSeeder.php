<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creamos el usuario principal
        User::create([
            'name' => 'Fernando Ruiz',
            'email' => 'dragon.binario@gmail.com',
            'password' => bcrypt('12345678')
            ]);

       //creamos usuarios de prueba     
       User::factory(99)->create();     


    }
}
