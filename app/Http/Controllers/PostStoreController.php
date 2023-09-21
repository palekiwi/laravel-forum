<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PostStoreController extends Controller
{
    public function __invoke(StorePostRequest $request, Discussion $discussion): Redirector|RedirectResponse
    {
        $post = Post::make($request->validated());

        $post->user()->associate($request->user());

        $post->discussion()->associate($discussion);

        $post->parent()->associate($discussion->post);

        $post->save();

        return redirect(route('discussions.show', $discussion).'?post='.$post->id);
    }
}
