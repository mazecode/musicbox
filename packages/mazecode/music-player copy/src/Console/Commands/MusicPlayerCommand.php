<?php

namespace Mazecode\MusicPlayer\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class MusicPlayerCommand
 * @package Mazecode\MusicPlayer\Console\Commands
 */
class MusicPlayerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Music player console command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return 'This is a test';
    }
}
