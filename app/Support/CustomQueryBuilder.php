<?php

namespace App\Support;

class CustomQueryBuilder
{
    /**
     * Apply filtered inputs to the query
     * @param $query
     * @param $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if(isset($data['f'])) {
            foreach($data['f'] as $filter) {
                $filter['match'] = isset($data['filter_match']) ? $data['filter_match'] : 'and';
                $this->makeFilter($query, $filter);
            }
        }

        return $query;
    }

    /**
     * Make a filter for the query
     * @param $query
     * @param $filter
     */
    protected function makeFilter($query, $filter)
    {
        if(strpos($filter['column'], '.') !== false) {
            // nested
            list($relation, $filter['column']) = explode('.', $filter['column']);

            $filter['match'] = 'and';

            if($filter['column'] == 'count') {
                $this->{\Str::camel($filter['operator'])}($filter, $query, $relation);
            } else {
                $query->whereHas($relation, function ($q) use ($filter){
                    $this->{\Str::camel($filter['operator'])}($filter, $q);
                });
            }

        } else {
            $this->{\Str::camel($filter['operator'])}($filter, $query);
        }
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function equalTo($filter, $query)
    {
        return $query->where($filter['column'], '=', $filter['query_1'], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function notEqualTo($filter, $query)
    {
        return $query->where($filter['column'], '!=', $filter['query_1'], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function lessThan($filter, $query)
    {
        return $query->where($filter['column'], '<', $filter['query_1'], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function greaterThan($filter, $query)
    {
        return $query->where($filter['column'], '>', $filter['query_1'], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function between($filter, $query)
    {
        return $query->whereBetween($filter['column'], [$filter['query_1'], $filter['query_2']], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function notBetween($filter, $query)
    {
        return $query->whereNotBetween($filter['column'], [$filter['query_1'], $filter['query_2']], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function contains($filter, $query)
    {
        return $query->where($filter['column'], 'like', '%'.$filter['query_1'].'%', $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function startsWith($filter, $query)
    {
        return $query->where($filter['column'], 'like', $filter['query_1'].'%', $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function endsWith($filter, $query)
    {
        return $query->where($filter['column'], 'like', '%'.$filter['query_1'], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function inThePast($filter, $query)
    {
        $end = now()->endOfDay();
        $begin = now();

        $format = isset($filter['query_2']) ? $filter['query_2'] : 'days';

        switch($format) {
            case 'hours':
                $begin->subHours($filter['query_1']); break;
            case 'days':
                $begin->subDays($filter['query_1'])->startOfDay(); break;
            case 'months':
                $begin->subMonths($filter['query_1'])->startOfDay(); break;
            case 'years':
                $begin->subYears($filter['query_1'])->startOfDay(); break;
            default:
                $begin->subDays($filter['query_1'])->startOfDay(); break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function inTheNext($filter, $query)
    {
        $begin = now()->startOfDay();
        $end = now();

        $format = isset($filter['query_2']) ? $filter['query_2'] : 'days';

        switch($format) {
            case 'hours':
                $end->addHours($filter['query_1']); break;
            case 'days':
                $end->addDays($filter['query_1'])->endOfDay(); break;
            case 'months':
                $end->addMonths($filter['query_1'])->endOfDay(); break;
            case 'years':
                $end->addYears($filter['query_1'])->endOfDay(); break;
            default:
                $end->addDays($filter['query_1'])->endOfDay(); break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function inThePeriod($filter, $query)
    {
        $begin = now();
        $end = now();

        switch($filter['query_1']) {
            case 'today':
                $begin->startOfDay();
                $end->endOfDay();
                break;
            case 'yesterday':
                $begin->subDay(1)->startOfDay();
                $end->subDay(1)->endOfDay();
                break;
            case 'tomorrow':
                $begin->addDay(1)->startOfDay();
                $end->addDay(1)->endOfDay();
                break;
            case 'last_month':
                $begin->subMonth(1)->startOfDay();
                $end->subMonth(1)->endOfDay();
                break;
            case 'this_month':
                $begin->startOfMonth();
                $end->endOfMonth();
                break;
            case 'next_month':
                $begin->addMonth(1)->startOfMonth();
                $end->addMonth(1)->endOfMonth();
                break;
            case 'last_year':
                $begin->subYear(1)->startOfYear();
                $end->subYear(1)->endOfYear();
                break;
            case 'this_year':
                $begin->startOfYear();
                $end->endOfYear();
                break;
            case 'next_year':
                $begin->addYear(1)->startOfYear();
                $end->addYear(1)->endOfYear();
                break;
            default: break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);
    }


    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function equalToCount($filter, $query, $relation)
    {
        return $query->has($relation, '=', $filter['query_1']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function notEqualToCount($filter, $query, $relation)
    {
        return $query->has($relation, '!=', $filter['query_1']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function lessThanCount($filter, $query, $relation)
    {
        return $query->has($relation, '<', $filter['query_1']);
    }

    /**
     * @param $filter
     * @param $query
     * @return mixed
     */
    protected function greaterThanCount($filter, $query, $relation)
    {
        return $query->has($relation, '>', $filter['query_1']);
    }
}
