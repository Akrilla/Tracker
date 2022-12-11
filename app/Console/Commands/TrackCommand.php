<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class TrackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track all stock.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Product::all()->each->track();

        $this->info("Tracked!");
    }
}
