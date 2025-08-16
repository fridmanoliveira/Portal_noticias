<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiscal extends Model
{
    use HasFactory;
    protected $table = 'fiscais';

    protected $fillable = ['nome', 'crea', 'cpf'];

    public function obra()
    {
        return $this->hasMany(Obra::class);
    }
}
