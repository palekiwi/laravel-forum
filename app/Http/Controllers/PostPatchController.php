<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPatchRequest as Request;
use App\Models\Post;

class PostPatchController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $post->update($request->validated());

        return back();
    }
}
