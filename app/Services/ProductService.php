<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function constructProductPriceStructure(Product $product): Product
    {
        return $product;
    }
}
