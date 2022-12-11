<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        if ($this->retailer->name === 'eBuyer') {
            $results = Http::get('http://retailer.test')->json();

            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
