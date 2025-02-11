<?php

namespace Modules\Social\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends \App\Entities\Follow
{
    use HasFactory;

    protected $fillable = ['follower_id', 'followed_id'];

    public function follower()
    {
        return $this->belongsTo(\Modules\Users\Entities\Usuarios::class, 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo(\Modules\Users\Entities\Usuarios::class, 'followed_id');
    }
}