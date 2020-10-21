<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get(route('profile.show',['user'   => $user->name,]))
            ->assertSee($user->name);
    }
    /** @test */
    public function test_profile_display_all_threads_created_by_associated_user()
    {
        $user = create('App\User');
        $thread = create('App\Thread', ['user_id' => $user->id]);
        $this->get(route('profile.show',['user'   => $user->name,]))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}
