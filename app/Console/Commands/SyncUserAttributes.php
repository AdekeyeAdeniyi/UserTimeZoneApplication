<?php

namespace App\Console\Commands;

use App\Jobs\BatchUpdateJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncUserAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-user-attributes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync user attributes with third-party API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch users whose attributes have changed within the last hour
        $users = DB::table('users')
            ->where('updated_at', '>=', now()->subMinutes())
            ->get();

        if ($users->isEmpty()) {
            $this->info("No users to sync.");
            return;
        }

        // Chunk users into batches of 1,000
        $chunks = $users->chunk(1000);

        foreach ($chunks as $chunk) {
            // Prepare user data for the API
            $userUpdates = $chunk->map(function ($user) {
                return [
                    'email' => $user->email,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'timezone' => $user->timezone,
                ];
            })->toArray();

            BatchUpdateJob::dispatch($userUpdates);
        }

        $this->info("User updates have been queued successfully.");
    }
}
