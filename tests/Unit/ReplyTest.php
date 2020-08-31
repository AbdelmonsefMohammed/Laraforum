<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    function test_it_has_an_owner()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('App\User', $thread->user);
    }
}
