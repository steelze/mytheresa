<?php

namespace App\Http\Controllers;

use App\Helpers\RespondWith;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return RespondWith::success();
    }
}
