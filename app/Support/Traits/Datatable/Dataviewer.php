<?php

namespace App\Support\Traits\Datatable;

use App\Support\CustomQueryBuilder;
use Illuminate\Support\Facades\Validator;

trait Dataviewer
{
    /**
     * Filter columns according to request
     * @param $query
     * @return mixed
     */
    public function scopeFilter($query)
    {
        return $this->process($query, request()->all())
            ->orderBy
                (
                    request('order_column', $this->timestamps ? 'created_at' : 'id'),
                    request('order_direction', 'desc')
                )
            ->paginate(request('limit', 10));
    }

    /**
     * Process returned data according to inputs
     * @param $query
     * @param $data
     * @return mixed
     * @throws \ErrorException
     */
    public function process($query, $data)
    {
        $validator = $this->validate($data);

        if($validator->fails()) {
            dd($validator->errors());
            throw new \ErrorException('Invalid Entered Data !');
        }

        return (new CustomQueryBuilder)->apply($query, $data);
    }

    /**
     * Validate requested data
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate($data)
    {
        return Validator::make($data, [
            'order_column' => 'sometimes|required|in:' . $this->orderableColumns(),
            'order_direction' => 'sometimes|required|in:asc,desc',
            'limit' => 'sometimes|required|integer|min:1',
            'filter_match' => 'sometimes|required|in:and,or',
            'f' => 'sometimes|required|array',
            'f.*.column' => 'required|in:' . $this->whiteListColumns(),
            'f.*.operator' => 'required_with:f.*.column|in:' . $this->allowedOperators(),
            'f.*.query_1' => 'required',
            'f.*.query_2' => 'required_if:f.*.operator,between,not_between',
        ]);
    }

    /**
     * Fetch allowed columns to filter by it
     * @return string
     */
    protected function whiteListColumns()
    {
        return implode(',', $this->allowedFilters);
    }

    /**
     * Allowed columns to order by
     * @return string
     */
    protected function orderableColumns()
    {
        return implode(',', $this->orderable);
    }

    /**
     * Allowed operators to filter by
     * @return string
     */
    protected function allowedOperators()
    {
        return implode(',', [
            'equal_to',
            'not_equal_to',
            'less_than',
            'greater_than',
            'between',
            'not_between',
            'contains',
            'starts_with',
            'ends_with',
            'in_the_past',
            'in_the_next',
            'in_the_period',
            'less_than_count',
            'greater_than_count',
            'equal_to_count',
            'not_equal_to_count',
        ]);
    }
}
