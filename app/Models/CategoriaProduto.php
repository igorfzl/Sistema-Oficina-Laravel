<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
