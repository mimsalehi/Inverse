<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CourseSalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Course|JsonResource $this */

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'sales' => $this->sales,
            'popularity' => $this->popularity,
            'total_sales' => $this->total_sales,
        ];
    }
}
