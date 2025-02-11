<?php

namespace App\Entities;

use App\Entities\Usuarios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {
    use HasFactory;

    protected $fillable = ['usuario_id', 'contenido'];

    public function usuarios()
    {
        return $this->belongsTo(\Modules\Users\Entities\Usuarios::class, "usuario_id");
    }
}