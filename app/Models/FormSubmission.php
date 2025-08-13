<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['email'];

    public function answers()
    {
        return $this->hasMany(FormAnswer::class);
    }
}
