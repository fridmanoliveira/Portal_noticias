<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoHome extends Model
{
    protected $table = 'video_home';
    protected $fillable = ['titulo', 'descricao', 'link_youtube', 'ativo'];
}
