<?php

use App\SocialLogin;
use Illuminate\Database\Seeder;

class SocialUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many genres you need, defaulting to 10
//        $count = (int)$this->command->ask('How many social logins do you need ?', 10);

//        $this->command->info("Creating {$count} social logins.");

        // Create the Genre
        $sls = App\SocialLogin::all();
        $users = App\User::all();



        $this->command->info('Users - Social Logins Created!');
    }
}
