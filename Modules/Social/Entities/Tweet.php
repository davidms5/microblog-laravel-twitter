<?php

namespace Modules\Social\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tweet extends \App\Entities\Tweet
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(\Modules\Users\Entities\Usuarios::class);
    }
}