<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = ['marca', 'modelo', 'ano', 'placa', 'cliente_id'];
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
