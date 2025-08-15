<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PpaSetting extends Model
{
    protected $table = 'ppa_settings';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'closed_message'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function isCurrentlyActive(): bool
    {
        $now = Carbon::now();

        // Se a data atual for antes da start_date ou depois da end_date, fecha
        if ($now->lt($this->start_date) || $now->gt($this->end_date)) {
            return false;
        }

        return (bool) $this->is_active;
    }
}
