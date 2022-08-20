<?php


namespace App\Services\Contract;


interface OrderServiceInterface
{
    /**
     * Gets the list of courses.
     *
     * @param array $request
     * @return mixed
     */
    public function list(array $request);

}
