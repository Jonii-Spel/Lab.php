<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; 
use App\User;
use Illuminate\Support\Facades\Hash;

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

        
        $response = $this->get('/usuarios')

        ->assertStatus(200)

        ->assertSee("usuario");
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

        $response->assertSee("Crear Usuario");
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

    /** @test */
    function the_email_must_be_valid()
    {
        $this->from('usuarios/nuevo')
            ->post('usuarios/',[
                'name' => 'Duilio',
                'email' => 'correo-no-valido',
                'name' => '1234567'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique()
    {

        factory(User::class)->create([
            'email' => 'chon@hotmail.com'
        ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Duilio',
                'email' => 'chon@hotmail.com',
                'name' => '1234567'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('usuarios/', [
                'name' => 'Duilio',
                'email' => 'chon@hotmail.com',
                'name' => ''
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

            $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar") //usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user){
                return $viewUser->id === $user->id;
            });
    }

    /** @test */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Guille',
            'email' => 'guille@gmail.com',
            'password' => '147852'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Guille',
            'email' => 'guille@gmail.com',
            'password' => '147852'
        ]);

    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {

        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => '',
                'email' => 'guille@gmail.com',
                'password' => '147852'
            ])->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'guille@gmail.com']);
  
    }

    /** @test */
    function the_email_must_be_valid_when_updating_the_user()
    {
        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Joni',
                'email' => 'correo-no-valido',
                'password' => '147852'
            ])->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Joni']);
  
    }

    /** @test */
    function the_email_must_be_unique_when_updating_the_user()
    {

        // $this->withoutExceptionHandling();

        factory(User::class)->create([
            'email' => 'existig-email@ejemplo.com',
        ]);

        $user = factory(User::class)->create([
            'email' => 'chon@hotmail.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' => 'Duilio',
                'email' => 'existig-email@ejemplo.com',
                'password' => '1234567'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        
    }

     /** @test */
     function the_email_can_stay_the_same_when_updating_the_user()
     {
        // $this->withoutExceptionHandling();
 
        $user = factory(User::class)->create([
             'email' => 'chon@hotmail.com',
         ]);
 
         $this->from("usuarios/{$user->id}/editar")
             ->put("usuarios/{$user->id}", [
                 'name' => 'Jonii Spelzini',
                 'email' => 'chon@hotmail.com',
                 'password' => '12345678'
             ])
             ->assertRedirect("usuarios/{$user->id}");
             
             $this->assertDatabaseHas('users', [
                 'name' => 'Jonii Spelzini',
                 'email' => 'chon@hotmail.com',
                
             ]);
     }

    /** @test */
    function the_password_is_opcional_when_updating_the_user()
    {
        $this->withoutExceptionHandling();

        $oldPass = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => Hash::make($oldPass)
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Jonii Spelzini',
                'email' => 'chon@hotmail.com',
                'password' => ''
            ])
            ->assertRedirect("usuarios/{$user->id}");
            
            $this->assertCredentials([
                'name' => 'Jonii Spelzini',
                'email' => 'chon@hotmail.com',
                'password' => $oldPass
            ]);
    }

    /** @test */
    function it_deletes_a_user()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->get("usuarios/{$user->id}/delete")
            ->assertRedirect(route('users'));
        
        $this->assertDatabaseMissing('users',[
            'id' => $user->id
        ]);

        $this->assertSame(0, User::count());
    }


}
