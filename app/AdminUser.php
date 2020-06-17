<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'tela_entrada_saida_veiculo',
        'tela_usuario',
        'tela_veiculo_caixa',
        'tela_tabela_preco',
        'tela_cadastrar_tipo_veiculo'
    
    ];
}
