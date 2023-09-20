<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Discussion;
use App\Models\Post;

class PostStoreController extends Controller
{
    public function __invoke(StorePostRequest $request, Discussion $discussion): void
    {
        $post = Post::make($request->validated());

        $post->user()->associate($request->user());

        $post->discussion()->associate($discussion);

        $post->parent()->associate($discussion->post);

        $post->save();

        redirect()->route('discussions.show', $discussion);
    }
}
