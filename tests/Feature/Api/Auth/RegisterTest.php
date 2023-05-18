<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Front Auth - login url.
     *
     * @var string
     */
    protected $logoutUrl = '/api/register';

    /** @test */
    public function successfully_register()
    {
        $password = 'Password123*';
        $this->postJson($this->logoutUrl, [
            'email' => 'a@a.a',
            'name' => 'test1235',
            'username' => Str::random(8),
            'phone' => '081390033212',
            'password' => $password,
            'password_confirmation' => $password,
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                ],
            ]);
    }
}
