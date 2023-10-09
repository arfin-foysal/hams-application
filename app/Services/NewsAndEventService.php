<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\NewsAndEvent;
use Illuminate\Support\Facades\Auth;

class NewsAndEventService
{
    use HelperTrait;
    public function categoryList()
    {
        $category = Category::get();
        return $this->apiResponse($category, 'Category List Get Successfully', true, 200);
    }

    public function saveOrUpdateCategory($request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $cate = [
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $request->is_active,
            ];

            if (empty($request->id)) {
                $category = Category::create($cate);
                $category->user_id = Auth::user()->id;
                $category->save();
                return $this->apiResponse([], 'Category Saved Successfully', true, 200);
            } else {
                $category = Category::find($request->id);
                $category->update($cate);
                return $this->apiResponse([], 'Category Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function categoryDelete($request)
    {
        try {
            $category = Category::find($request->id);
            $category->delete();
            return $this->apiResponse([], 'Category Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function newsAndEventList()
    {
        try {
            $newsAndEvents = NewsAndEvent::get();
            return $this->apiResponse($newsAndEvents, 'News And Event List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function newsAndEventSaveOrUpdate($request)
    {
        try {
            $newsAndEvents = [
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ];
            if (empty($request->id)) {
                $newsAndEvent = NewsAndEvent::create($newsAndEvents);


                if ($request->hasFile('image')) {
                    $newsAndEvent->image = $this->imageUpload($request, 'image', 'image');
                }
                $newsAndEvent->user_id = Auth::user()->id;
                $newsAndEvent->save();

                return $this->apiResponse([], 'News And Event Saved Successfully', true, 200);
            } else {
                $newsAndEvent = NewsAndEvent::find($request->id);
                $newsAndEvent->update($newsAndEvents);
                if ($request->hasFile('image')) {
                    $newsAndEvent->image = $this->imageUpload($request, 'image', 'image', $newsAndEvent->image);
                }
                $newsAndEvent->save();
                return $this->apiResponse([], 'News And Event Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function newsAndEventPage($request)
    {
        try {

            $category_id = $request->query('category_id');
            $search = $request->query('search');

            $newsAndEvent = NewsAndEvent::when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })->get();
            return $this->apiResponse($newsAndEvent, 'News And Event Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function newsDetailsPage($request)
    {
        try {
            $newsAndEvent = NewsAndEvent::find($request->id)->first();
            return $this->apiResponse($newsAndEvent, 'News And Event Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function recentPost()
    {
        try {
            $newsAndEvent = NewsAndEvent::orderBy('id', 'desc')->take(4)->get();
            return $this->apiResponse($newsAndEvent, 'News And Event Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }


    }


    public function photoGalleryList()
    {
        try {
            $newsAndEvent = NewsAndEvent::orderBy('id', 'desc')->take(4)->get();
            return $this->apiResponse($newsAndEvent, 'News And Event Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function photoGalleryListPage ($request)
    {
        try {

            $page = 0;
            $limit = $request->limit;

            $newsAndEvent = NewsAndEvent::orderBy('updated_at', 'desc')->paginate($limit, ['*'], 'page', $page);
            return $this->apiResponse($newsAndEvent, 'News And Event Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }


    }

}
