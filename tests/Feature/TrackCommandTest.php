<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{

    use RefreshDatabase;

    /**
        @test
     */
    public function track_product_stock()
    {
        $this->seed(RetailerWithProductSeeder::class);

        $this->assertFalse(Product::first()->inStock());

        Http::fake(function () {
            return [
                'available' => true,
                'price' => '450'
            ];
        });
        
        $this->artisan('track')
            ->expectsOutput("Tracked!");

        $this->assertTrue(Product::first()->inStock());
    }
}
