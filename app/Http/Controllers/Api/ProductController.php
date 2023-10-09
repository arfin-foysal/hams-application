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

    public function productCategory(Request $request)
    {
        return $this->productService->productCategory($request);
    }

    public function productCategorySaveOrUpdate(Request $request)
    {
        return $this->productService->productCategorySaveOrUpdate($request);
    }

    public function productList()
    {
        return $this->productService->productList();
    }

    public function saveOrUpdateProduct(Request $request)
    {
        return $this->productService->saveOrUpdateProduct($request);
    }

    public function productByCategoryId(Request $request)
    {
        return $this->productService->productByCategoryId($request);
    }

    public function productDetails(Request $request)
    {
        return $this->productService->productDetails($request);
    }

}
