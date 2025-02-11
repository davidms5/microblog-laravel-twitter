<?php

namespace Modules\Social\Repository;

use Exception;
use Illuminate\Support\Facades\Redis;
use Modules\Social\Entities\Follow;
use Modules\Social\Entities\Tweet;

class SocialRepository
{
    public function createTweet($request)
    {
        try {
            $usuario_id = $request["usuario_id"];
            $contenido = $request["contenido"];

            return Tweet::create([
                "usuario_id" => $usuario_id,
                "contenido"  => $contenido
            ]);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getUserTweets($user_id, $perPage = 20)
    {
        try {
            return Tweet::where('user_id', $user_id)
            ->latest()
            ->paginate($perPage);

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }

    public function clearFollowersCache($user_id, $followers)
    {
        try {
           foreach ($followers as $follower) {
            Redis::del("user:{$follower}:timeline");
            } 
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }

    /**
     * Seguir a un usuario
     */
    public function followUsuario($follower_id, $followed_id)
    {
        try {
          return Follow::create([
            'follower_id' => $follower_id,
            'followed_id' => $followed_id
            ]);  
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }

    /**
     * Dejar de seguir a un usuario
     */
    public function unfollowUsuario($follower_id, $followed_id)
    {
        try {
          return Follow::where('follower_id', $follower_id)
            ->where('followed_id', $followed_id)
            ->delete();  
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }

    /**
     * Verificar si un usuario ya sigue a otro
     */
    public function isFollowing($follower_id, $followed_id)
    {
       
        return (bool) Follow::where('follower_id', $follower_id)
        ->where('followed_id', $followed_id)
        ->exists();  
        
    }

    /**
     * Obtener los seguidores de un usuario
     */
    public function getFollowers($user_id)
    {
        try {
          return Follow::where('followed_id', $user_id)
            ->pluck('follower_id');  
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }
}