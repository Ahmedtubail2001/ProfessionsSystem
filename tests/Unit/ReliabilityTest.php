<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class ReliabilityTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDatabaseReliability()
    {
        $user = User::factory()->create(); // Create a new user using the factory

        $retrievedUser = User::find($user->id); // Retrieve the user from the database

        $this->assertEquals($user->id, $retrievedUser->id); // Assert that the retrieved user has the same ID as the created user
    }
}
