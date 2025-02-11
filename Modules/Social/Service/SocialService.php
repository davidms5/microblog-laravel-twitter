<?php

namespace Modules\Social\Service;

use Exception;
use Illuminate\Support\Facades\Redis;
use Modules\Social\Repository\SocialRepository;

class SocialService 
{
    protected $socialRepository;

    public function __construct(SocialRepository $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    public function createTweet($request)
    {
        try {
            $usuario_id = $request["usuario_id"];

            $tweet = $this->socialRepository->createTweet($request);

            // Borrar la caché de los seguidores
            $followers = $this->socialRepository->getFollowers($usuario_id);
            $this->socialRepository->clearFollowersCache($usuario_id, $followers);

            return $tweet;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function follow($request)
    {
        try {
            $follower_id = $request["follower_id"];
            $followed_id = $request["followed_id"];

            if($this->socialRepository->isFollowing($follower_id, $followed_id)) {
                return new Exception("ya sigues a este usuario", 400);
            }

            $this->socialRepository->followUsuario($follower_id, $followed_id);

            // Limpiar caché del timeline del usuario que sigue
            Redis::del("user:{$follower_id}:timeline");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function unfollow($request)
    {
        try {
            $follower_id = $request["follower_id"];
            $followed_id = $request["followed_id"];

            if($this->socialRepository->isFollowing($follower_id, $followed_id)) throw new Exception("no sigues a este usuario", 400);

            $this->socialRepository->unfollowUsuario($follower_id, $followed_id);

            // Borrar la caché del timeline del usuario que dejó de seguir
            Redis::del("user:{$follower_id}:timeline");
            
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}