<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
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
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $ebuyer = Retailer::create(['name' => 'eBuyer']);

        $this->assertFalse($switch->inStock());

        $stock = new Stock([
            'price' => 399,
            'product_id' => $switch->id,
            'in_stock' => false
        ]);

        $ebuyer->addStock($switch, $stock);

        Http::fake(function () {
            return [
                'available' => true,
                'price' => '450'
            ];
        });
        $this->artisan('track');

        $this->assertTrue($stock->fresh()->in_stock);
    }
}
