<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Product;

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
            $products = [
                'home_product_section_id' => $request->home_product_section_id,
                'client_id' => $request->client_id,
                'sort_title' => $request->sort_title,
                'title' => $request->title,
                'sort_description' => $request->sort_description,
                'delivery_date' => $request->delivery_date,
                'description' => $request->description,
                'facebook_link' => $request->facebook_link,
                'youtube_link' => $request->youtube_link,
                'linkedin_link' => $request->linkedin_link,
                'is_active' => $request->is_active,
            
            ];
            
            if (empty($request->id)) {
                $product = Product::create($products);
                if ($request->hasFile('featured_image')) {
                    $product->featured_image = $this->imageUpload($request, 'featured_image', 'image');
                }
                if ($request->hasFile('image')) {
                    $product->image = $this->imageUpload($request, 'image', 'image');
                }
                $product->save();

                return $this->apiResponse([], 'Product Saved Successfully', true, 200);
            } else {
                $product = Product::find($request->id);
                $product->update($products);
                if ($request->hasFile('featured_image')) {
                    $product->featured_image = $this->imageUpload($request, 'featured_image', 'image', $product->featured_image);
                }
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
}
