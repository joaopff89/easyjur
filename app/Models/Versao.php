<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Versao extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'versoes';
    protected $fillable = ['nome'];
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime', 'deleted_at' => 'datetime'];
}
