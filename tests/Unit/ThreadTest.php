<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    function test_thread_has_replies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->thread->replies
        );
    }

    function test_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->user);
    }

    function test_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body'=> 'Foobar',
            'user_id' => 1
        ]);
        $this->assertCount(1, $this->thread->replies);
    }

    function test_thread_belongs_to_channel()
    {
        $thread = create('App\Thread');
        
        $this->assertInstanceOf('App\Channel', $thread->channel);
    }
}
