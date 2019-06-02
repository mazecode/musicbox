<?php

use Illuminate\Database\Seeder;

class SocialLoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rrss = ['Facebook', 'Google', 'Github', 'LinkedIn', 'Twitter'];
        $icon = [
            'facebook' => 'fab facebook-f',
            'github' => 'fab github-alt',
            'google' => 'fab google',
            'linkedin' => 'fab linkedin-in',
            'twitter' => 'fab twitter'
        ];

        foreach ($rrss as $rs) {
            App\SocialLogin::create([
                    'name' => $rs,
                    'driver' => strtolower($rs),
                    'icon' => $icon[strtolower($rs)]
                ]
            );
        }

        $this->command->info('Social Logins Created!');
    }
}
