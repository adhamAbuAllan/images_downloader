<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
}
