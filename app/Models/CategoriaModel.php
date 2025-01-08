<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';

    protected $primaryKey = 'id';

    protected $fillable = ['nome', 'grupo'];

    public function categorias()
    {
        return $this->hasMany(CategoriaModel::class);
    }
}
