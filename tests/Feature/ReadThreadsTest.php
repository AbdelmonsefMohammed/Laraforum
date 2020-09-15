<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function test_a_user_can_browse_threads()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);

    }

    /** @test */
    public function test_a_user_can_view_a_single_thread()
    {
    
        $response = $this->get(route('threads.show', [
            'channel' => $this->thread->channel->slug,
            'thread'  => $this->thread->id
        ]));
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create('App\Reply', ['thread_id'  => $this->thread->id]);
        
        $response = $this->get(route('threads.show', [
            'channel' => $this->thread->channel->slug,
            'thread'  => $this->thread->id
        ]));

        $response->assertSee($reply->body);

    }

    public function test_a_user_can_filter_threads_according_to_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get(route('channels.show', ['channel' => $channel->slug]))
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }

    public function test_a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'monsef']));
        $threadByMonsef = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByMonsef = create('App\Thread');
        $this->get('threads?by=monsef')
            ->assertSee($threadByMonsef->title)
            ->assertDontSee($threadNotByMonsef->title);
    }
}
