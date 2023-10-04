<?php

namespace App\Http\Traits;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

trait HelperTrait
{
    protected function apiResponse($data = null, $message = null, $status = null, $statusCode = null)
    {
        $array = [
            'data' => $data,
            'message' => $message? $message : 'Success',
            'status' => $status? $status : true,
        ];
        return response()->json($array, $statusCode? $statusCode : Response::HTTP_OK);
    }

    protected function codeGenerator($prefix, $model)
    {
        if ($model::count() == 0) {
            $newId = $prefix . "-" . str_pad(1, 5, 0, STR_PAD_LEFT);
            return $newId;
        }
        $lastId = $model::orderBy('id', 'desc')->first()->id;
        $lastIncrement = substr($lastId, -3);
        $newId = $prefix . "-" . str_pad($lastIncrement + 1, 5, 0, STR_PAD_LEFT);
        $newId++;
        return $newId;
    }
    // ex: $req,'image','icon',$class->image
    protected function imageUpload($request, $image, $destination, $old_image = null)
    {
        $images = null;
        $images_url = null;
        if ($request->hasFile($image)) {
            if ($old_image != null) {
                $old_image_path = public_path('uploads/' . $old_image);
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
            $image = $request->file($image);
            $time = time();
            $images = "bb_". rand(1,9) . $time . '.' . $image->getClientOriginalExtension();
            $destinations = 'uploads/' . $destination;
            $image->move($destinations, $images);
            $images_url = $destination . '/' . $images;
        }
        return $images_url;
    }

    protected function imageUploadWithPrefix($request, $image, $destination, $prefix, $old_image = null)
    {
        $images = null;
        $images_url = null;
        if ($request->hasFile($image)) {
            if ($old_image != null) {
                $old_image_path = public_path('uploads/' . $old_image);
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
            $image = $request->file($image);
            $time = time();
            $images = $prefix . '_' . $time . '.' . $image->getClientOriginalExtension();

            $destinations = 'uploads/' . $destination;
            $image->move($destinations, $images);
            $images_url = $destination . '/' . $images;
        }
        return $images_url;
    }

    //delete image Ex:icon/12346.png
    protected function deleteImage($image)
    {
        $image_path = public_path('uploads/' . $image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        return true;
    }

}
