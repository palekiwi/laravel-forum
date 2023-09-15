<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class DiscussionShowController extends Controller
{
    public function __invoke(Discussion $discussion): Response
    {
        $discussion->load(['topic']);
        $discussion->loadCount('replies');

        return Inertia::render('Forum/Show', [
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user', 'discussion'])
                    ->oldest()
                    ->paginate(10)
            ),
        ]);
    }
}
