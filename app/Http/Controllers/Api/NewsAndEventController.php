<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NewsAndEventService;
use Illuminate\Http\Request;

class NewsAndEventController extends Controller
{
    protected $newsAndEventService;

    public function __construct(NewsAndEventService $newsAndEventService)
    {
        $this->newsAndEventService = $newsAndEventService;
    }

    public function categoryList()
    {
        return $this->newsAndEventService->categoryList();
    }

    public function saveOrUpdateCategory(Request $request)
    {
        return $this->newsAndEventService->saveOrUpdateCategory($request);
    }

    public function newsAndEventList()
    {
        return $this->newsAndEventService->newsAndEventList();
    }

    public function saveOrUpdateNewsAndEvent(Request $request)
    {
        return $this->newsAndEventService->newsAndEventSaveOrUpdate($request);
    }

    public function newsAndEventPage(Request $request)
    {
        return $this->newsAndEventService->newsAndEventPage($request);
    }

    public function newsDetailsPage(Request $request)
    {
        return $this->newsAndEventService->newsDetailsPage($request);
    }

    public function recentPost()
    {
        return $this->newsAndEventService->recentPost();
    }

}
