<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    use HelperTrait;
    public function productList()
    {
        try {
            $products = Product::get();
            return $this->apiResponse($products, 'Product List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function saveOrUpdateProduct($request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $products = [
                'product_category_id' => $request->product_category_id,
                'client_id' => $request->client_id,
                'short_title' => $request->sort_title,
                'title' => $request->title,
                'short_description' => $request->sort_description,
                'delivery_date' => $request->delivery_date,
                'description' => $request->description,
                'facebook_link' => $request->facebook_link,
                'youtube_link' => $request->youtube_link,
                'linkedin_link' => $request->linkedin_link,
                'is_active' => $request->is_active,

            ];

            if (empty($request->id)) {
                $product = Product::create($products);
                if ($request->hasFile('image')) {
                    $product->image = $this->imageUpload($request, 'image', 'image');
                }
                $product->save();

                return $this->apiResponse([], 'Product Saved Successfully', true, 200);
            } else {
                $product = Product::find($request->id);
                $product->update($products);
                if ($request->hasFile('image')) {
                    $product->image = $this->imageUpload($request, 'image', 'image', $product->image);
                }
                $product->save();
                return $this->apiResponse([], 'Product Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function productCategory ($request)
    {
        try {
            $productCategory = ProductCategory::get();
            return $this->apiResponse($productCategory, 'Product Category List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function productCategorySaveOrUpdate($request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $category = [
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ];

            if (empty($request->id)) {
                $productCategory = ProductCategory::create($category);
                if ($request->hasFile('image')) {
                    $productCategory->image = $this->imageUpload($request, 'image', 'image');
                }
                $productCategory->save();

                return $this->apiResponse([], 'Product Category Saved Successfully', true, 200);
            } else {
                $productCategory = ProductCategory::find($request->id);
                $productCategory->update($category);
                if ($request->hasFile('image')) {
                    $productCategory->image = $this->imageUpload($request, 'image', 'image', $productCategory->image);
                }
                $productCategory->save();
                return $this->apiResponse([], 'Product Category Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }

    }

    // client site api start

    public function productByCategoryId($request)
    {
        try {
            $page = 0;
            $limit = $request->limit;
            $products = Product::where('is_active', 1)
                ->where('product_category_id', $request->id)
            
                ->select(
                    'id',
                    'product_category_id',
                    'client_id',
                    'image',
                    'short_title',
                    'title',
                    'short_description',
                    'description'
                )
                ->orderBy('updated_at', 'desc')->paginate($limit, ['*'], 'page', $page);
            return $this->apiResponse($products, 'Product List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function productDetails($request)
    {
        try {
        
            $product = Product::where('id', $request->id)->first();
            return $this->apiResponse($product, 'Product Details Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }
}
