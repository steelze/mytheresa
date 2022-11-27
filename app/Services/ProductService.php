<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function getProductPricingInfo(Product $product): array
    {
        // Apply discount

        return [
            'original' => $product->price,
            'final' => $product->price,
            'discount_percentage' => null,
            'currency' => config('app.currency'),
        ];
    }

    public function getDiscountsAvailableForProduct(Product $product): Collection
    {
        $discounts = collect(config('discounts'));

        return $discounts;
    }
}
