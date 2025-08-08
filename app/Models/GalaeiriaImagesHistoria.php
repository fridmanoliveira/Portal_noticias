<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalaeiriaImagesHistoria extends Model
{
    protected $table = 'galeria_images_historia';
    protected $fillable = ['video_id', 'image_path'];

    public function video()
    {
        return $this->belongsTo(VideoHome::class, 'video_home_id');
    }
}
