<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productList()
    {
        return $this->productService->productList();
    }

    public function saveOrUpdateProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        return $this->productService->saveOrUpdateProduct($request);
    }

}
