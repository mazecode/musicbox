<?php

namespace Mazecode\MusicLibrary\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenreTableSeeder::class);
        $this->call(AlbumTableSeeder::class);
        $this->call(ArtistTableSeeder::class);
    }
}
