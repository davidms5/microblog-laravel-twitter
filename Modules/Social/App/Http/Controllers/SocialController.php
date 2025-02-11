<?php

namespace Modules\Social\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Social\App\Http\Requests\CreateTweetRequest;
use Modules\Social\App\Http\Requests\FollowUserRequest;
use Modules\Social\App\Http\Requests\UnfollowUserRequest;
use Modules\Social\Service\SocialService;

class SocialController extends Controller
{
    protected $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('social::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('social::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createTweet(CreateTweetRequest $request)
    {
        try {
            return response()->json($this->socialService->createTweet($request), 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function follow(FollowUserRequest $request)
    {
        try {
            $this->socialService->follow($request);
            return response()->json(['message' => 'Ahora sigues a este usuario'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
    
    public function unfollow(UnfollowUserRequest $request)
    {
        try {
            $this->socialService->unfollow($request);
            return response()->json(['message' => 'Has dejado de seguir a este usuario'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
