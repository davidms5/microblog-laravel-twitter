<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = "usuarios";
    protected $fillable = ['name', 'email'];
}