<?php


namespace App\Services\Implementation;


use App\Models\Course;
use App\Services\Contract\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{

    public function list(array $request)
    {
        $query = Order::query();

        return $courses->paginate($request['limit'] ?? Course::DEFAULT_PAGINATION_LIMIT);
    }
}
