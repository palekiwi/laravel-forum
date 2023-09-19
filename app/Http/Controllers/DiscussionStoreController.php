<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionRequest;
use App\Models\Discussion;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;

class DiscussionStoreController extends Controller
{
    public function __invoke(StoreDiscussionRequest $request): RedirectResponse
    {
        /* Create the discussion */
        $discussion = Discussion::make([
            'title' => $request->title,
        ]);

        $discussion->user()->associate($request->user());

        $discussion->topic()->associate(Topic::find($request->topic_id));

        $discussion->save();

        /* Create the first post */
        $post = Post::make([
            'body' => $request->body,
        ]);

        $post->user()->associate($request->user());

        $discussion->posts()->save($post);

        /* Return a redirect response */
        return redirect()->route('discussions.show', $discussion);

    }
}
