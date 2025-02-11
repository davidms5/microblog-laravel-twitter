<?php

namespace Modules\Timeline\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Timeline\App\Http\Requests\ShowTimelineRequest;
use Modules\Timeline\Service\TimelineService;

class TimelineController extends Controller
{

    protected $timelineService;

    public function __construct(TimelineService $timelineService)
    {
        $this->timelineService = $timelineService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('timeline::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('timeline::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function showTimeline(ShowTimelineRequest $request)
    {
        try {
            return response()->json($this->timelineService->showTimeline($request), 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('timeline::edit');
    }


}
