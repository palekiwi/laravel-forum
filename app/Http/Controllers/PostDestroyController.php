<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostDestroyRequest as Request;
use App\Models\Post;

class PostDestroyController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $post->delete();

        return back();
    }
}
