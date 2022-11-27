<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'sku' => '000001',
                'name' => 'BV Lean leather ankle boots',
                'category' => 'boots',
                'price' => 89000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => '000002',
                'name' => 'BV Lean leather ankle boots',
                'category' => 'boots',
                'price' => 99000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => '000003',
                'name' => 'Ashlington leather ankle boots',
                'category' => 'boots',
                'price' => 71000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => '000004',
                'name' => 'Naima embellished suede sandals',
                'category' => 'sandals',
                'price' => 79500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'sku' => '000005',
                'name' => 'Nathane leather sneakers',
                'category' => 'sneakers',
                'price' => 59000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        Product::factory(50)->create();
    }
}
