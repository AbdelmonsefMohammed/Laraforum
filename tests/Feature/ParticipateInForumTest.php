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
        $this->withExceptionHandling()
            ->post(route('reply.store',[
                'channel'   => 'somechannel',
                'thread'    => '1'
            ]))
            ->assertRedirect('login');
    }
    /** @test */
    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        // be make the user the authenticated user
        // $this->be($user = factory('App\User')->create());
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post(route('reply.store',[
                'channel'   => $thread->channel->slug,
                'thread'    => $thread->id
            ]) , $reply->toArray());

        $this->get(route('threads.show',[
                'channel'   => $thread->channel->slug,
                'thread'    => $thread->id
            ]))->assertSee($reply->body); 


    }
}
