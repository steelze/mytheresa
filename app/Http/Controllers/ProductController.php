<?php

namespace App\Http\Controllers;

use App\Helpers\RespondWith;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $service): JsonResponse
    {
        $limit = $request->limit ?? 5;
        $q = $request->q;
        $max = $request->priceLessThan;

        $products = Product::query()
            ->when($q, fn($sql) => $sql->where('category', 'like', '%' . $q . '%'))
            ->when((!is_null($max) && is_numeric($max)), fn($sql) => $sql->where('price', '<=', $max))
            ->paginate($limit);

        $products->getCollection()->transform(function ($product) use ($service) {
            $product->price = $service->getProductPricingInfo($product);
            return $product;
        });

        return RespondWith::success($products);
    }
}
