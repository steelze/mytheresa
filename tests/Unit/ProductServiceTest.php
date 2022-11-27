<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use PHPUnit\Framework\TestCase;

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

        $data = (new ProductService)->constructProductPriceStructure($product);

        $this->assertEquals($price, $data->price->final);
        $this->assertEquals($price, $data->price->original);
        $this->assertEquals(null, $data->price->discount_percentage);
        // $this->assertJsonStructure([
        //     'price' => [
        //         'original',
        //         'final',
        //         'discount_percentage',
        //         'currency',
        //     ],
        // ]);
    }

    public function test_that_discount_is_applied_if_available(): void
    {
        $price = 141000;
        $discount = 10;

        $final_price = ($discount / 100) * $price;

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->constructProductPriceStructure($product);

        $this->assertEquals($final_price, $data->price->final);
        $this->assertEquals($price, $data->price->original);
        $this->assertEquals($discount.'%', $data->price->discount_percentage);
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

        $data = (new ProductService)->constructProductPriceStructure($product);

        $this->assertEquals($price, $data->price->final);
        $this->assertEquals($price, $data->price->original);
        $this->assertEquals(null, $data->price->discount_percentage);
    }

    public function test_that_highest_discount_is_applied_if_multiple_discount_is_available(): void
    {
        $price = 141000;

        $first_discount = 10;
        $second_discount = 15;

        $discount = ($first_discount > $second_discount) ? $first_discount : $second_discount;

        $final_price = ($discount / 100) * $price;

        $product = new Product([
            'sku' => '0000003',
            'name' => 'Iphone 14 Pro Max',
            'category' => 'Boot',
            'price' => $price,
        ]);

        $data = (new ProductService)->constructProductPriceStructure($product);

        $this->assertEquals($final_price, $data->price->final);
        $this->assertEquals($price, $data->price->original);
        $this->assertEquals($discount.'%', $data->price->discount_percentage);
    }
}
