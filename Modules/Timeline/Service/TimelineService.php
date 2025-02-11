<?php

namespace Modules\Timeline\Service;

use Exception;
use Illuminate\Support\Facades\Redis;
use Modules\Timeline\Repository\TimelineRepository;

class TimelineService
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository)
    {
        $this->timelineRepository = $timelineRepository;
    }

    public function showTimeline($request)
    {
        try {
            $usuario_id = $request["usuario_id"];

            $cacheKey = "user:{$usuario_id}:timeline";
            $cachedTimeline = Redis::get($cacheKey);
            if ($cachedTimeline !== null) {
                return json_decode($cachedTimeline, true);
            }
            
            $tweets = $this->timelineRepository->showTimeline($usuario_id);

            // Guardar en Redis por 10 minutos
            Redis::setex($cacheKey, 600, json_encode($tweets));

            $response = [
                "usuario_id"        => (int) $usuario_id,
                "timeline"          => $tweets->items(),
                "paginacion"        => [
                    "total"         => $tweets->total(),
                    "current_page"  => $tweets->currentPage(),
                    "per_page"      => $tweets->perPage(),
                    "last_page"     => $tweets->lastPage(),
                    "next_page_url" => $tweets->nextPageUrl(),
                    "prev_page_url" => $tweets->previousPageUrl()
                ]
            ];

            return $response;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}