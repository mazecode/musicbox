<?php

namespace Mazecode\MusicLibrary\Seeds;

use Illuminate\Database\Seeder;
use Mazecode\MusicLibrary\Models\Album;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // DB::table('artist_albums')->truncate();
        // Album::truncate();
        // Schema::enableForeignKeyConstraints();

        Album::create([
            'name' => 'Album de Prueba',
        ]);

        Album::create([
            'name' => 'Album de Prueba 2',
        ]);
    }
}
