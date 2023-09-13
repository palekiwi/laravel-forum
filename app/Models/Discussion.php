<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperDiscussion
 */
class Discussion extends Model
{
    use HasFactory;

    public function scopeOrderByPinned(Builder $query): void
    {
        $query->orderBy('pinned_at', 'asc');
    }

    public function isPinned(): bool
    {
        return ! is_null($this->pinned_at);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
