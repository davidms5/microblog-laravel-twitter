<?php

namespace Modules\Timeline\Repository;

use Exception;
use Modules\Timeline\Entities\Tweet;

class TimelineRepository
{
    public function showTimeline($usuario_id)
    {
        try {
            $tweets = Tweet::with("usuarios")
            ->whereIn("usuario_id", function ($query) use ($usuario_id) {
                $query->select("followed_id")
                ->from("follows")
                ->where("follower_id", $usuario_id);
            })
            ->latest()
            ->paginate(10);

            return $tweets;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}