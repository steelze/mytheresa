<?php

namespace App\Http\Controllers;

use App\Helpers\RespondWith;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $limit = $request->limit ?? 5;

        $products = Product::paginate($limit);
        return RespondWith::success($products);
    }
}
