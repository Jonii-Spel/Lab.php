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
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $response = $this->get('/usuarios/99');
        $response->assertStatus(404);
        $response->assertSee('Pagina no encontrada !!!');
    }

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

        $response->assertSee("");
    }

    /** @test */
    function it_creates_a_new_user()
    {
        
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'Guille',
            'email' => 'guille@gmail.com',
            'password' => '147852'
        ])->assertRedirect(route('users'));

        $this->assertCredentials([
            'name' => 'Guille',
            'email' => 'guille@gmail.com',
            'password' => '147852'
        ]);

    }

    /** @test */
    function the_name_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'guille@gmail.com',
                'password' => '147852'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());
      
        // $this->assertDatabaseMissing('users',[
        //     'email' => 'guille@gmail.com'
        // ]);

    }
}
