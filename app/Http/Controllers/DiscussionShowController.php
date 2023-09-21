<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiscussionShowController extends Controller
{
    protected const POSTS_PER_PAGE = 4;

    public function __invoke(Request $request, Discussion $discussion): RedirectResponse|Response
    {
        if ($postId = $request->get('post')) {
            return redirect()->route('discussions.show', [
                'discussion' => $discussion,
                'page' => $this->getPageForPost($discussion, $postId),
                'postId' => $postId,
            ]);
        }

        $discussion->load(['topic', 'post.discussion']);
        $discussion->loadCount('replies');

        return Inertia::render('Forum/Show', [
            'query' => $request->query(),
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user', 'discussion'])
                    ->oldest()
                    ->paginate(self::POSTS_PER_PAGE)
            ),
        ]);
    }

    /**
     * @param  mixed  $postId
     */
    protected function getPageForPost(Discussion $discussion, $postId): int
    {
        $index = $discussion->posts->search(fn ($p) => $p->id == $postId);
        //dd($discussion->posts);

        $page = (int) ceil(($index + 1) / self::POSTS_PER_PAGE);

        return $page;
    }
}
