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

        $wutang = Artist::create([
            'name' => 'Wu-Tang Clan'
        ]);

        Artist::create([
            'name' => 'Method Man',
            'band' => $wutang->id
        ]);

        $nwa = Artist::create([
            'name' => 'NWA',
        ]);

        Artist::create([
            'name' => 'Ice Cube',
            'band' => $nwa->id
        ]);
    }
}
