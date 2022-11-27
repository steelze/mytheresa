<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function getProductPricingInfo(Product $product): array
    {
        $discount = 0;
        $discount_percentage = null;
        $discounts_available = $this->getDiscountsAvailableForProduct($product);

        if ($discounts_available->isNotEmpty()) {
            $maximum_discount = $this->getMaximumDiscount($discounts_available);
            $discount_percentage = $maximum_discount['value'].'%';
            $discount = $this->calculateProductDiscount($product, $maximum_discount);
        }

        return [
            'original' => $product->price,
            'final' => $product->price - $discount,
            'discount_percentage' => $discount_percentage,
            'currency' => config('app.currency'),
        ];
    }

    public function getDiscountsAvailableForProduct(Product $product): Collection
    {
        $discounts = collect(config('discounts'));

        return $discounts->whereIn('key', [$product->category, $product->sku]);
    }

    public function getMaximumDiscount(Collection $discounts): array
    {
        if($discounts->count() === 1) return $discounts->first();

        $max = $discounts->max('value');

        return $discounts->firstWhere('value', $max);
    }

    public function getProductDiscount(Product $product): ?array
    {
        $discounts_available = $this->getDiscountsAvailableForProduct($product);

        return ($discounts_available->isNotEmpty())
            ? $this->getMaximumDiscount($discounts_available)
            : null;
    }

    public function calculateProductDiscount(Product $product, array $discount): int
    {
        $value = $discount['value'];

        return ($value / 100) * $product->price;
    }
}
