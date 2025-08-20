<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemObra extends Model
{
    protected $fillable = ['obra_id', 'image_path'];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
