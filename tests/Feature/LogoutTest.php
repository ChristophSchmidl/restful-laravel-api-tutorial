<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogoutTest extends TestCase
{

    /*
     * It’s important to note that, during testing, the Laravel application is
     * not instantiated again on a new request. Which means that when we hit the
     * authentication middleware, it saves the current user inside the TokenGuard
     * instance to avoid hitting the database again. A wise choice, however—in this
     * case, it means we have to split the logout test into two, to avoid any
     * issues with the previously cached user.
     */

    public function testUserIsLoggedOutProperly()
    {
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('get', '/api/articles', [], $headers)->assertStatus(200);
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        // Simulating login
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->json('get', '/api/articles', [], $headers)->assertStatus(401);
    }

}
