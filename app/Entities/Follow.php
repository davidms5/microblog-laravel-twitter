<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model {

    protected $fillable = ['follower_id', 'followed_id'];
}