<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Inertia\Inertia;
use Inertia\Response;

class ForumIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Forum/Index', [
            'discussions' => DiscussionResource::collection(
                Discussion::with(['topic'])
                    ->paginate(10)
            ),
        ]);
    }
}
