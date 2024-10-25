<?php

namespace Tests\Feature;

use App\Jobs\BatchUpdateJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class BatchUpdateJobTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_creates_batches_correctly(): void
    {
        // Arrange: Create a user chunk for testing
        $userChunk = User::factory()->count(1000)->create()->toArray();

      
        Http::fake([
            'api.fakeendpoint.com/update' => Http::sequence()
                ->push(['status' => 'success'], 200) 
        ]);

       
        BatchUpdateJob::dispatch($userChunk);

        // Run the queued jobs
        $this->artisan('queue:work --once');

        // Assert: Verify that the HTTP requests were made
        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.fakeendpoint.com/update' &&
                $request['users'] !== null; 
        });
        }
}
