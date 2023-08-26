<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\ImagesRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(ImageRequest $request)
    {
        $image = $this->saveImage($request);
        return [
            'success' => true,
            'message' => 'Image uploaded successfully.',
            'image' => $image
        ];
    }

    public function uploadImages(ImagesRequest $request)
    {
        $images = $request->images;
        $uploaded_images = [];
        foreach ($images as $image) {
            $uploaded_images[] = $this->saveImage(new ImageRequest([
                'image' => $image,
                'folder_name' => $request->folder_name
            ]));
        }

        return [
            'success' => true,
            'message' => 'Images uploaded successfully.',
            'images' => $uploaded_images
        ];
    }

    private function saveImage(ImageRequest $request)
    {
        $path = 'images/' . $request->folder_name . '/';
        $public_path = public_path($path);

        $image_name = uniqid() . time() . '.' . $request['image']->extension();
        $request['image']->move($public_path, $image_name);

        $full_url_image = asset($path . $image_name);
        $partial_url_image = $path . $image_name;
        return [
            'full_url_image' => $full_url_image,
            'partial_url_image' => $partial_url_image,
            'image_name' => $image_name
        ];
    }
}
