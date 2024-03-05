<?php

namespace App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'app_id',
        'url',
        'download_counter',
    ];
    protected $table = "images";
    protected $casts = [
        'download_counter' => 'integer',
        'url' => 'array',

    ];
    public function setFilenamesAttribute($value){
        $this->attributes['url']=json_encode($value);
    }
    public function myapps():BelongsTo{
        return $this->belongsTo(MyApp::class,'app_id');
    }
}
