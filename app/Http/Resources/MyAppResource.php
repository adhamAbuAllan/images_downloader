<?php

namespace App\Http\Resources;
use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'app_name'=>$this->app_name??"",
            'images'=>$this->images,
            'images_counter'=>$this->images_counter??0
        ];
    }
}
