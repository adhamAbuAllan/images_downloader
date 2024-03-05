<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Image;

class MyApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_name',
    ];
    protected $table = "myapps";
    public function image():HasMany{
        return $this->hasMnay(Image::class);
    }
}
