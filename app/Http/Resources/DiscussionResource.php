<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DiscussionResource
 *
 * @mixin \App\Models\Discussion
 * */
class DiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'is_pinned' => $this->isPinned(),
            'topic' => TopicResource::make($this->whenLoaded('topic')),
            'post' => PostResource::make($this->whenLoaded('post')),
            'solution' => PostResource::make($this->whenLoaded('solution')),
            'replies_count' => $this->replies_count,
            'latestPost' => PostResource::make($this->whenLoaded('latestPost')),
            'participants' => PublicUserResource::collection(
                $this->whenLoaded('participants')
            ),
            'user_can' => [
                'reply' => auth()->user()?->can('reply', $this->resource),
                'delete' => auth()->user()?->can('delete', $this->resource),
                'solve' => auth()->user()?->can('solve', $this->resource),
            ],
        ];
    }
}
