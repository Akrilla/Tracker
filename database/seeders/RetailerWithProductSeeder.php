<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class RetailerWithProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $ebuyer = Retailer::create(['name' => 'eBuyer']);

        $ebuyer->addStock($switch, new Stock([
            'price' => 399,
            'product_id' => $switch->id,
            'in_stock' => false
        ]));
    }
}
