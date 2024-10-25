<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserDetailsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_users_update_command()
    {
      
        User::factory()->count(20)->create();

        // Run the command
        $this->artisan('app:update-user-details')
             ->assertExitCode(0);

     
        $users = User::all();

        foreach ($users as $user) {
            $this->assertNotNull($user->firstname);
            $this->assertNotNull($user->lastname);
            $this->assertNotNull($user->timezone);
        }
    }
    
}
