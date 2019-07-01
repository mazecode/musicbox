<?php

namespace Mazecode\MusicPlayer\Seeds;

use Illuminate\Database\Seeder;
use Mazecode\MusicPlayer\Models\Album;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::truncate();

        Album::create([
            'name' => 'Album de Prueba',
        ]);

        Album::create([
            'name' => 'Album de Prueba 2',
        ]);

        $this->command->info('Album\'s dummy data ready');
    }
}
