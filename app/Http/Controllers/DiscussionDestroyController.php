<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionDestroyRequest as Request;
use App\Models\Discussion;
use Illuminate\Http\RedirectResponse;

class DiscussionDestroyController extends Controller
{
    public function __invoke(Request $request, Discussion $discussion): RedirectResponse
    {
        $discussion->delete();

        return redirect()->route('home');
    }
}
