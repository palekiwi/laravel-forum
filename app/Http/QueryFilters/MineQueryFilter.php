<?php

namespace App\Http\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class MineQueryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (! auth()->user()) {
            return $query;
        }

        return $query->whereBelongsTo(auth()->user());
    }
}
