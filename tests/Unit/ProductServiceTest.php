<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    public function test_that_product_model_structure_is_returned(): void
    {
        $price = 141000;

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals(null, $data['discount_percentage']);
    }

    public function test_that_discount_is_applied_if_available(): void
    {
        $price = 141000;
        $discount = 10;

        $final_price = $price - (($discount / 100) * $price);

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $final_price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals($discount.'%', $data['discount_percentage']);
    }

    public function test_that_discount_is_not_applied_if_not_available(): void
    {
        $price = 141000;

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals(null, $data['discount_percentage']);
    }

    public function test_that_highest_discount_is_applied_if_multiple_discount_is_available(): void
    {
        $price = 141000;

        $first_discount = 10;
        $second_discount = 15;

        $discount = ($first_discount > $second_discount) ? $first_discount : $second_discount;

        $final_price = $price - (($discount / 100) * $price);

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $final_price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals($discount.'%', $data['discount_percentage']);
    }
}
