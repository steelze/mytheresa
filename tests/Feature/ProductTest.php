<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_user_can_fetch_all_products(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAll(['status', 'message', 'data'])
            )
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'sku',
                            'name',
                            'category',
                            'price' => [
                                'original',
                                'final',
                                'discount_percentage',
                                'currency',
                            ],
                        ],
                    ],
                    'prev_page_url',
                    'next_page_url',
                ],
            ]);
    }
}
