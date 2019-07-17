<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        $this->command->info('Seeding default users');

        User::create([
            'name' => 'Mazecode',
            'username' => 'mazecode',
            'email' => 'maze@code.cl',
            'password' => bcrypt('maze')
        ]);

        $this->command->line('Default users inserted');

        // How many genres you need, defaulting to 10
        $count = (int)$this->command->ask('How many users do you need ?', 10);

        $this->command->info("Creating {$count} users.");

        // Create the Genre
        $users = factory(User::class, $count)->create();

        $this->command->info('Users Created!');
    }
}
