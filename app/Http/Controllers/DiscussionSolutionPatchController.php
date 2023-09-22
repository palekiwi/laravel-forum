<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionSolutionPatchRequest as Request;
use App\Models\Discussion;
use App\Models\Post;

class DiscussionSolutionPatchController extends Controller
{
    public function __invoke(Request $request, Discussion $discussion)
    {
        // make sure post id is within this topic

        $discussion->solution()->associate(Post::find($request->post_id));

        $discussion->save();

        return back();
    }
}
