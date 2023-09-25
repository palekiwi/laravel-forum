<?php

namespace App\Http\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class MentionedQueryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (! auth()->user()) {
            return $query;
        }

        return $query->whereHas('posts', function (Builder $query) {
            $query->whereHas('mentions', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            });
        });
    }
}
