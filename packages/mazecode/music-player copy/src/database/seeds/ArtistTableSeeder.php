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
        // Artist::truncate();

        $wutang = Artist::create([
            'name' => 'Wu-Tang Clan',
            'is_music_band' => true
        ]);

        $meth = Artist::create([
            'name' => 'Method Man',
        ]);

        $wutang->members()->save($meth);

        $nwa = Artist::create([
            'name' => 'NWA',
            'is_music_band' => true
        ]);

        $icec = Artist::create([
            'name' => 'Ice Cube',
        ]);

        $easye = Artist::create([
            'name' => 'Eazy-E',
        ]);

        $nwa->members()->save($icec);
        $nwa->members()->save($easye);
    }
}
