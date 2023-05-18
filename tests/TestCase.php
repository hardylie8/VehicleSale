<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * get JWT Token Heeader for the test environment.
     *
     * @return array
     */
    protected function getTokenHeaders(): array
    {
        $user = User::factory()->create();
        $token = Auth::attempt(['email' => $user->email, 'password' => 'password']);
        return ['Authorization' => 'Bearer' . $token];
    }
}
