<?php

use Illuminate\Database\Seeder;
use App\SocialLogin;
use App\Pivots\SocialUser;
use App\User;

class SocialLoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // SocialUser::truncate();// User::truncate();
        // SocialLogin::truncate();
        // Schema::enableForeignKeyConstraints();

        $rrss = ['Facebook', 'Google', 'Github', 'LinkedIn', 'Twitter'];
        $icon = [
            'facebook' => 'fab facebook-f',
            'github' => 'fab github-alt',
            'google' => 'fab google',
            'linkedin' => 'fab linkedin-in',
            'twitter' => 'fab twitter'
        ];

        foreach ($rrss as $rs) {
            SocialLogin::create([
                    'name' => $rs,
                    'driver' => strtolower($rs),
                    'icon' => $icon[strtolower($rs)]
                ]
            );
        }

        $this->command->info('Social Logins Created!');
    }
}
