<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Veiculo;

class Cliente extends Model
{
    use HasFactory;


    protected $fillable = ['nome', 'email', 'telefone', 'endereco'];


    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
