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

    public function test_guest_users_may_not_create_thread()
    {
        $this->withExceptionHandling();
        $this->get(route('threads.create'))
                ->assertRedirect('/login');
        $this->post(route('threads.store'))
                ->assertRedirect('/login');

    }
    // there is error here
    public function test_an_authorized_user_can_make_a_thread_post()
    {
        // Given we have signed in user  [ We can use actingAs() instead of be()]
        $this->signIn();
        //When we hit endpoint to create new thread
        $thread = make('App\Thread');
        $response = $this->post(route('threads.store'), $thread->toArray());
        //Then, when we visit the thread page  we should see the new thread
        $this->get($response->headers->get('Location'))->assertSee($thread->title)
                ->assertSee($thread->body);

    }
    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
                ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
                ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => null])
                ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
                ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $overrides);


        return $this->post('/threads', $thread->toArray());
    }
}
