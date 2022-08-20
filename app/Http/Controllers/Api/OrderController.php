<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterCoursesRequest;
use App\Http\Resources\CourseResource;
use App\Services\Contract\OrderServiceInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @var OrderServiceInterface
     */
    protected $orderService;

    /**
     * OrderController constructor.
     * @param OrderServiceInterface $orderService
     */
    public function __construct(
        OrderServiceInterface $orderService
    )
    {
        $this->orderService = $orderService;
    }

    /**
     * Gets the list of courses.
     *
     * @param FilterCoursesRequest $request
     * @return JsonResponse
     */
    public function index(FilterCoursesRequest $request): JsonResponse
    {
        $courses = $this->orderService->list($request->validated());
        return response()->json(CourseResource::collection($courses));
    }
}
