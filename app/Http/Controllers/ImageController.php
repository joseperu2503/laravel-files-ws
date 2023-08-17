<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload_image(ImageRequest $request)
    {
        $path = public_path('images/');

        $image_name = uniqid() . time() . '.' . $request['image']->extension();
        $request['image']->move($path, $image_name);

        $full_url_image = asset('images/'.$image_name);
        $partial_url_image = 'images/'.$image_name;
        return [
            'success' => true,
            'message' => 'Image uploaded successfully.',
            'full_url_image' => $full_url_image,
            'partial_url_image' => $partial_url_image,
            'image_name' => $image_name
        ];
    }
}
