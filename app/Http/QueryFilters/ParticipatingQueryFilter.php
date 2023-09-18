<?php

namespace App\Http\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ParticipatingQueryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (! auth()->user()) {
            return $query;
        }

        return $query
            ->where('user_id', '!=', auth()->id())
            ->whereHas('posts', function (Builder $query) {
                $query->whereBelongsTo(auth()->user());
            });
    }
}
