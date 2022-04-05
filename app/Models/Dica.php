<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dica extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'tipo_id', 'marca_id', 'modelo_id', 'versao_id', 'descricao'];
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime', 'deleted_at' => 'datetime'];
}
