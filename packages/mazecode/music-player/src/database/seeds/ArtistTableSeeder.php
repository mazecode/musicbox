<?php

namespace Mazecode\MusicPlayer\Seeds;

use Illuminate\Database\Seeder;
use Mazecode\MusicPlayer\Models\Artist;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::truncate();
        Band::truncate();

        $wutang = Band::create([
            'name' => 'Wu-Tang Clan'
        ]);

        Artist::create([
            'name' => 'Method Man',
            'band' => $wutang->id
        ]);

        $nwa = Band::create([
            'name' => 'NWA',
        ]);

        Artist::create([
            'name' => 'Ice Cube',
            'band' => $nwa->id
        ]);
    }
}
