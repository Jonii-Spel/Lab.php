<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profession;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $professions = DB::select('SELECT id FROM professions 
        // WHERE title =?', ['Desarrollador back-end']);

        $professionBack = \App\Profession::where('title', 'Back-end developer')->value('id');

        $professionDis = \App\Profession::where('title', 'Diseñador')->value('id');

        

        // Modelo ElOqUEnt    

        User::create([
            'name' => 'Jonii Spelzini',
            'email' => 'chon@hotmail.com',
            'password' => bcrypt('78945'),
            'profession_id' => $professionBack
            
        ]);

        User::create([
            'name' => 'Juana de arco',
            'email' => 'juana99@hotmail.com',
            'password' => bcrypt('asdvcav'),
            'profession_id' => $professionDis
            
        ]);

        User::create([
            'name' => 'Miguel',
            'email' => 'migue@outlook.com',
            'password' => bcrypt('miguelxd'),
            'profession_id' => null
            
        ]);

        // Modelo Factory

        factory(User::class)->create([
            'name' => 'Miguel',
            'email' => 'migue@outlook.com',
            'password' => bcrypt('miguelxd'),
            'profession_id' => null
            
        ]);

        factory(User::class)->create([
            'profession_id' => $professionDis
        ]);

        factory(User::class, 15)->create();

        // Modelo Constructor de consultas

        DB::table('users')->insert([
            'name' => 'Jonii Spelzini',
            'email' => 'chon@hotmail.com',
            'password' => bcrypt('78945'),
            'profession_id' => $professionBack
            
        ]);

    }
}