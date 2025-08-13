<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type', // 'radio' or 'checkbox'
        'order',
        'is_required',
        'section'
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order');
    }
}
