<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * logout url.
     *
     * @var string
     */
    protected $logoutUrl = '/api/logout';

    /** @test */
    public function successfully_logout()
    {
        $headers = $this->getTokenHeaders();
        $this->postJson($this->logoutUrl, [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                ],
            ]);
    }
}
