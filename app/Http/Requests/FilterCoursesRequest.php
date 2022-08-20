<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class FilterCoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function validated(): array
    {
        $validated = parent::validated();

        if (!isset($validated['limit'])){
            $validated['limit'] = Course::DEFAULT_PAGINATION_LIMIT;
        }

        if (!isset($validated['sort_key'])){
            $validated['sort_key'] = 'created_at';
        }

        if (!isset($validated['sort_dir'])){
            $validated['sort_dir'] = 'desc';
        }

        return $validated;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:150'],
            'min_price' => ['nullable', 'numeric', 'min:500000', 'max:3000000'],
            'max_price' => ['nullable', 'numeric', 'min:500000', 'max:3000000'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'limit' => ['nullable', 'integer', 'min:5', 'max:500'],
            'sort_key' => ['nullable', 'string', 'in:price,rating,date'],
            'sort_dir' => ['nullable', 'string', 'in:desc,asc'],
        ];
    }
}
