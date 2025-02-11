<?php

namespace App\Entities;

use App\Entities\Usuarios;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

    protected $fillable = ['usuario_id', 'contenido'];

}