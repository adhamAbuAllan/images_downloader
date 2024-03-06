<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function all (Request $request){
        $images = Image::orderBy('download_counter', 'desc')->get();
        
        // Return the images as a response, you can modify this according to your requirements
        return $this->success($images);
       }

       public function add(Request $request){
        $fields = [
            'images.*'=>'required|image|mimes:jpeg,png,jpg',
            'app_id' =>'required|exists:myapps,id'
        ];
        $validator= Validator::make($request->all(),$fields);
        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }
        $uploadeImages = [];
        $images = $request->file('images');
        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }
        $appId = $request->input('app_id');
        foreach($images as $image){
            $imageName = 'img_'. rand(1,1000) . '.png';
            $dir = "images";
            $image->move(public_path($dir),$imageName);
            $path = $dir . '/' . $imageName;
            $quitUrl  = url($path);
            $data = Image::create([
                'url'=>$quitUrl,
                'app_id'=>$appId,
            ]);
            $uploadeImages[] = $data;
            return $this->success($uploadeImages);
        }
       }
       public function imageCounter(Request $request)
       {
           $imagesCounter = Image::max('image_counter'); // Get the maximum value of image_counter
           $newCounterValue = $imagesCounter + 1; // Increment the value by 1
       
           $data = Image::create([
               'image_counter' => $newCounterValue,
           ]);
       
           return $this->success($data);
       }
    }

