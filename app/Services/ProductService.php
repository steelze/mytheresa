<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getProductPricingInfo(Product $product): array
    {
        // Apply discount

        return [
            'original' => $product->price,
            'final' => $product->price,
            'discount_percentage' => '30%',
            'currency' => config('app.currency'),
        ];
    }
}
