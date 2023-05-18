<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * login url.
     *
     * @var string
     */
    protected $loginUrl = '/api/login';

    /** @test */
    public function login_failed_using_invalid_credential()
    {

        $this->postJson($this->loginUrl, [
            'email' => 'admin@admin.net',
            'password' => 'password',
        ])
            ->assertStatus(401)
            ->assertJsonFragment(['message' => 'Unauthorized/wrong password or id']);
    }

    /** @test */
    public function login_success_using_a_valid_credential()
    {
        $user = User::factory()->create();

        $this->postJson($this->loginUrl, [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user',
                    'token',
                    'type',
                ],
            ]);
    }
}
