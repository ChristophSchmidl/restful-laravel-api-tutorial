<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    /*
     * These methods test a couple of simple cases. The json() method hits the endpoint and
     * the other asserts are pretty self explanatory. One detail about assertJson():
     * this method converts the response into an array searches for the argument,
     * so the order is important. You can chain multiple assertJson() calls in that case.
     */


    /**
     * @test
     */
    public function requires_email_and_login()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    /**
     * @test
     */
    public function user_logins_successfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('toptal123'),
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => 'toptal123'];

        $response = $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

        //dd($response); show whole response with statusCode and so on
        //$response->dump(); only show me the data/json

    }
}
