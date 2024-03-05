<?php

namespace App\Http\Controllers;
use App\Models\MyApp;
use App\Http\Resources\MyAppResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyAppController extends Controller
{
    public function add(Request $request){
        $fields = [
            'app_name',
        ];
        $validator= Validator::make($request->all(),$fields);
        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }
        $appName = $request->app_name;
        $data = MyApp::create([
            'app_name'=>$appName,
        ]);
    }
  
    public function all (Request $request){
       
        $myApps = MyApp::with(['images' => function ($query) {
            $query->orderBy('download_counter', 'desc');
        }])->get();
     
        $myAppsResource = MyAppResource::collection($myApps);
 
        return $this->success($myAppsResource);
    }
    
    
}
  // public function all (Request $request){
    //     $myApps = MyApp::all();
    //     // $myAppsResource = ;
    //     return $this->success(MyAppResource($myApps));
    // }