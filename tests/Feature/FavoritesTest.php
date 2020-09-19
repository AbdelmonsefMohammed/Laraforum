<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    
    /** @test */
    public function test_guests_canot_favorite_anything()
    {
        $this->withExceptionHandling()
        ->post(route('favorite.store',[
            'reply'   => 1,
        ]))->assertRedirect('/login');
    }
    /** @test */
    public function test_an_authenticated_user_can_favor_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->post(route('favorite.store',[
            'reply'   => $reply->id,
        ]));

        $this->assertCount(1, $reply->favorites);
    }

        /** @test */
        public function test_an_authenticated_user_may_only_favorite_a_reply_once()
        {
            $this->signIn();
            $reply = create('App\Reply');
    
            try{
                $this->post(route('favorite.store',[
                    'reply'   => $reply->id,
                ]));
                $this->post(route('favorite.store',[
                    'reply'   => $reply->id,
                ]));
            }catch(\Exception $e){
                $this->fail('Did not expect to insert the same record twice.');
            }
            $this->assertCount(1, $reply->favorites);
        }

}
