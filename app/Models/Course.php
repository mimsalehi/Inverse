<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Course
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property float $price
 * @property float $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Order[] $orders
 *
 * @property-read float|null $sales
 * @property-read integer|null $orders_count
 *
 * @package App\Models
 */
class Course extends Model
{
    use HasFactory;

    const DEFAULT_PAGINATION_LIMIT = 25;

    /**
     * Orders of a course
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'course_order');
    }
}
