<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estrutura extends Model
{
    protected $fillable = ['codigo_produto_pai', 'codigo_produto_filho', 'quantidade'];

    public function produtoPai()
    {
        return $this->belongsTo(Produto::class, 'codigo_produto_pai', 'codigo_produto');
    }

    public function produtoFilho()
    {
        return $this->belongsTo(Produto::class, 'codigo_produto_filho', 'codigo_produto');
    }

}
