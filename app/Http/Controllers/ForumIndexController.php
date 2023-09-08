<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ForumIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Forum/Index');
    }
}
