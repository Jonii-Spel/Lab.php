<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::insert('INSERT INTO professions (title) VALUES (:title)', [
        //     'title' => 'Desarrollador back-end',
        // ]);

        // Profession::create([
        //     'title' => 'Back-end developer'
        // ]);
        
        // Profession::create([
        //     'title' => 'Diseñador'
        // ]);

        // Profession::create([
        //     'title' => 'Desarrollador'
        // ]);
            
        // factory(Profession::class)->times(15)->create();
        
        
        //CONSTRUCTORES DE CONSULTAS !!!
        
        // DB::table('professions')->insert([
        //     'title' => 'Back-end developer'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Diseñador'
        // ]);
    }
}