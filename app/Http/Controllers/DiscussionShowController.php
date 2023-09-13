<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Inertia\Inertia;
use Inertia\Response;

class DiscussionShowController extends Controller
{
    public function __invoke(Discussion $discussion): Response
    {
        $discussion->load(['topic']);

        return Inertia::render('Forum/Show', [
            'discussion' => DiscussionResource::make($discussion),
        ]);
    }
}
