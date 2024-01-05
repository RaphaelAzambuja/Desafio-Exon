<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['codigo_produto', 'descricao', 'custo_unitario'];
    protected $primaryKey = 'codigo_produto';
    public $incrementing = false;

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['codigo_produto'])) {
            $query->where('codigo_produto', 'like', '%' . $filters['codigo_produto'] . '%');
        }

        if (isset($filters['descricao'])) {
            $query->where('descricao', 'like', '%' . $filters['descricao'] . '%');
        }

        return $query;
    }
}
