<?php


namespace App\Services\Contract;


use Illuminate\Http\Request;

interface CourseServiceInterface
{
    /**
     * Gets the list of courses.
     *
     * @param array $request
     * @return mixed
     */
    public function list(array $request);

    /**
     * Gets the sales of courses.
     *
     * @param array $request
     * @return mixed
     */
    public function sales(array $request);
}
