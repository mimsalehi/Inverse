<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterCoursesRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseSalesResource;
use App\Services\Contract\CourseServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @var CourseServiceInterface
     */
    protected $courseService;

    /**
     * CourseController constructor.
     * @param CourseServiceInterface $courseService
     */
    public function __construct(
        CourseServiceInterface $courseService
    )
    {
        $this->courseService = $courseService;
    }

    /**
     * Gets the list of courses.
     *
     * @param FilterCoursesRequest $request
     * @return JsonResponse
     */
    public function index(FilterCoursesRequest $request): JsonResponse
    {
        $courses = $this->courseService->list($request->validated());
        return response()->json(CourseResource::collection($courses));
    }

    /**
     * Gets the sales of courses.
     *
     * @param FilterCoursesRequest $request
     * @return JsonResponse
     */
    public function sales(FilterCoursesRequest $request): JsonResponse
    {
        $courses = $this->courseService->sales($request->validated());
        return response()->json(CourseSalesResource::collection($courses));
    }
}
