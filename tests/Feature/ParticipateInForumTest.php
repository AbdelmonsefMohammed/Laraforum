<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies' , []);
    }
    /** @test */
    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        // be make the user the authenticated user
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make();

        $this->post('/threads/' . $thread->id . '/replies' , $reply->toArray());

        $this->get('/threads/' . $thread->id)
                ->assertSee($reply->body); 


    }
}
