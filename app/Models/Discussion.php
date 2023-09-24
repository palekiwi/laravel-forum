<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Discussion extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title', 'slug',
    ];

    protected static function booted(): void
    {
        static::created(function (Discussion $discussion) {
            $discussion->update(['slug' => $discussion->title]);
        });
    }

    public function toSearchableArray(): array
    {
        return $this->only('id', 'title');
    }

    /**
     * @param  mixed  $value
     */
    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = $this->id.'-'.Str::slug($value);
    }

    public function scopeOrderByPinned(Builder $query): void
    {
        $query->orderBy('pinned_at', 'asc');
    }

    public function scopeOrderByLastPost(Builder $query): void
    {
        $query->orderBy(
            Post::select('created_at')
                ->whereColumn('posts.discussion_id', 'discussions.id')
                ->latest()
                ->take(1),
            'desc');
    }

    public function isPinned(): bool
    {
        return ! is_null($this->pinned_at);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function post(): HasOne
    {
        return $this->hasOne(Post::class)->oldestOfMany('created_at');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'asc');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class)
            ->whereNotNull('parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function latestPost(): HasOne
    {
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function participants(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Post::class,
            'discussion_id', 'id', 'id', 'user_id'
        )->distinct();
    }

    public function solution(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'solution_post_id');
    }
}
