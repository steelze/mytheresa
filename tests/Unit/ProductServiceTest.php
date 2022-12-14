<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Config::set('discounts', [
            [
                'type' => 'category',
                'key' => 'boots',
                'value' => 30,
            ],
            [
                'type' => 'sku',
                'key' => '000003',
                'value' => 15,
            ],
        ]);
    }

    public function test_that_product_model_structure_is_returned(): void
    {
        $price = 79500;

        $product = new Product([
            'sku' => '0000001',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Phone',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals(null, $data['discount_percentage']);
    }

    public function test_that_discount_is_applied_if_available(): void
    {
        $price = 89000;

        $product = new Product([
            'sku' => '0000001',
            'name' => 'BV Lean leather ankle boots',
            'category' => 'boots',
            'price' => $price,
        ]);

        $discount = (new ProductService)->getProductDiscount($product)['value'];

        $final_price = $price - (($discount / 100) * $price);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $final_price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals($discount.'%', $data['discount_percentage']);
    }

    public function test_that_discount_is_not_applied_if_not_available(): void
    {
        $price = 79500;

        $product = new Product([
            'sku' => '0000001',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Phone',
            'price' => $price,
        ]);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals(null, $data['discount_percentage']);
    }

    public function test_that_highest_discount_is_applied_if_multiple_discount_is_available(): void
    {
        $price = 89000;

        $product = new Product([
            'sku' => '0000003',
            'name' => 'BV Lean leather ankle boots',
            'category' => 'boots',
            'price' => $price,
        ]);

        $discount = (new ProductService)->getProductDiscount($product)['value'];

        $final_price = $price - (($discount / 100) * $price);

        $data = (new ProductService)->getProductPricingInfo($product);

        $this->assertEquals((int) $final_price, $data['final']);
        $this->assertEquals((int) $price, $data['original']);
        $this->assertEquals($discount.'%', $data['discount_percentage']);
    }
}
