<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
        'district',
        'age_range',
        'suggestions',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(FormAnswer::class);
    }
}
