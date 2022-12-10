<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /**
        @test
     */
    public function check_stock_for_products_at_retailers()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $ebuyer = Retailer::create(['name' => 'eBuyer']);

        $this->assertFalse($switch->inStock());

        $stock = new Stock([
            'price' => 399,
            'product_id' => $switch->id,
            'in_stock' => true
        ]);

        $ebuyer->addStock($switch, $stock);

        $this->assertTrue($switch->inStock());
    }
}
