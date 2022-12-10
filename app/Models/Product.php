<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inStock()
    {
        return $this->stock()->where('current_stock', '>', 0)->count() > 0;
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
