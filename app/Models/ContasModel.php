<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContasModel extends Model
{
    protected $table = 'contas';

    protected $primaryKey = 'id';

    protected $fillable = ['data','tipo', 'descricao', 'categoria', 'valor', 'status'];

    public function contas()
    {
        return $this->hasMany(ContasModel::class);
    }
}
