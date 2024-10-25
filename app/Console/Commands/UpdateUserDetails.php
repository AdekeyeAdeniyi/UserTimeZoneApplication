<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

use Faker\Factory as Faker;

class UpdateUserDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $faker = Faker::create();
        $timezones = ['CET', 'CST', 'GMT+1'];
        $users = User::all();

        foreach ($users as $user) {
            $user->firstname = $faker->firstName();
            $user->lastname = $faker->lastName();
            $user->timezone = $faker->randomElement($timezones);
            $user->save();
        }

        $this->info('User details updated successfully.');

    }
}
