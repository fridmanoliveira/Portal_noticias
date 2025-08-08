<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalaleiriaImagesTurismo extends Model
{
    protected $table = 'galeria_images_turismo';

    protected $fillable = [
        'turismo_id',
        'image_path',
    ];

    public function turismo()
    {
        return $this->belongsTo(Turismo::class, 'turismo_id');
    }
}
