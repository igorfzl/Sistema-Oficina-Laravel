<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'valor'];


    public function ordensServico()
    {
        return $this->belongsToMany(OrdemServico::class, 'ordem_servico_servico')
            ->withPivot('valor_cobrado')
            ->withTimestamps();
    }
}
