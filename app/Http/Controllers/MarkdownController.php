<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class MarkdownController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'html' => app(MarkdownRenderer::class)->toHtml($request->body ?? ''),
        ]);
    }
}
