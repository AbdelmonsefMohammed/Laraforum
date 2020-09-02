<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_guest_users_cant_see_create_thread_page()
    {
        $this->withExceptionHandling()
                ->get('/threads/create')
                ->assertRedirect('/login');

    }

    public function test_an_unauthorized_user_can_not_make_a_thread_post()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

    }

    public function test_an_authorized_user_can_make_a_thread_post()
    {
        // Given we have signed in user  [ We can use actingAs() instead of be()]
        $this->signIn();
        //When we hit endpoint to create new thread
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
        //Then, when we visit the thread page  we should see the new thread
        $this->get('/threads/'. $thread->id)
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
