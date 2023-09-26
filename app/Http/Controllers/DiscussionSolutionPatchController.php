<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionSolutionPatchRequest as Request;
use App\Models\Discussion;
use Illuminate\Http\RedirectResponse;

class DiscussionSolutionPatchController extends Controller
{
    public function __invoke(Request $request, Discussion $discussion): RedirectResponse
    {
        $discussion->solution()->associate($discussion->posts->find($request->post_id));

        $discussion->save();

        return back();
    }
}
