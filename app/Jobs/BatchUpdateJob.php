<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BatchUpdateJob implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels;

     protected $userChunk;

    /**
     * Create a new job instance.
     */
    public function __construct($userChunk)
    {
        $this->userChunk = $userChunk;
 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $endpoint = env('API_UPDATE_URL'); 
        $payload = ['users' => $this->userChunk];

         try {
            $response = Http::post($endpoint, $payload);
            if (!$response->successful()) {
                Log::error("API Error: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Batch update failed: " . $e->getMessage());
        }
    }
}
