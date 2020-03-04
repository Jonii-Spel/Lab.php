<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; 
use App\User;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_users_list_page()
    {

        
        $response = $this->get('/usuarios');

        $response->assertStatus(200);

        $response->assertSee("usuarios");
    }

    /** @test */
    function it_display_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Jonii Spel'
            
        ]);

        
        $response = $this->get('/usuarios/'.$user->id)

        ->assertStatus(200)

        ->assertSee("Jonii Spel");
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $response = $this->get('/usuarios/nuevo');

        $response->assertStatus(200);

        $response->assertSee("Crear nuevo user");
    }
}
