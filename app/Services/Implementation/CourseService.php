<?php


namespace App\Services\Implementation;


use App\Models\Course;
use App\Services\Contract\CourseServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CourseService implements CourseServiceInterface
{

    private function init_filtered_query(array $request)
    {
        $query = Course::query()
            ->when(isset($request['title']), function ($query) use ($request) {
                $query->where('title', 'like', sprintf('%%%s%%', $request['title']));
            })
            ->when(isset($request['slug']), function ($query) use ($request) {
                $query->where('slug', 'like', sprintf('%%%s%%', $request['slug']));
            })
            ->when(isset($request['description']), function ($query) use ($request) {
                $query->where('description', 'like', sprintf('%%%s%%', $request['description']));
            })
            ->when(isset($request['min_price']), function ($query) use ($request) {
                $query->where('price', '>=', $request['min_price']);
            })
            ->when(isset($request['max_price']), function ($query) use ($request) {
                $query->where('price', '<=', $request['max_price']);
            })->when(isset($request['rating']), function ($query) use ($request) {
                $query->where('rating', '>=', $request['rating']);
            });


        return $query;
    }

    public function list(array $request)
    {
        $courses = $this->init_filtered_query($request);

        // Sorting the results
        if (isset($request['sort_key'])) {
            $courses->orderBy($request['sort_key'], $request['sort_dir'] ?? 'desc');
        }

        return $courses->take($request['limit'] ?? Course::DEFAULT_PAGINATION_LIMIT)->get();
    }

    public function sales(array $request)
    {
        $courses = $this->init_filtered_query($request);
        $courses->with(['orders']);

        $courses = $courses->take($request['limit'] ?? Course::DEFAULT_PAGINATION_LIMIT)->get();

        $courses->each(function ($item) {
            $orders = $item->orders;

            if (is_null($orders) || empty($orders)) {
                $item->sales = null;
                $item->popularity = 0;
                $item->total_sales = 0;
                return;
            }

            $item->sales = $orders->groupBy(function ($order) {
                return Carbon::parse($order->created_at)->monthName;
            })->map(function ($group) use ($item) {
                return [
                    'count' => $group->count(),
                    'sales' => $group->count() * $item->price,
                ];
            });

            $item->popularity = $item->sales->sum(function ($value) {
                return $value['count'];
            });

            $item->total_sales = $item->sales->sum(function ($value) {
                return $value['sales'];
            });
        });

        $sorted = $courses->sortByDesc(function ($course, $key) {
            return $course->popularity ?? 0;
        });

        return $sorted->values()->all();

    }
}
