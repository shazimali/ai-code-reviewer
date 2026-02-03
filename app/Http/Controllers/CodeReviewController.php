<?php

namespace App\Http\Controllers;

use App\Services\AiReviewService;
use App\Services\MockAiReviewService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CodeReviewController extends Controller
{
    protected AiReviewService $aiService;

    public function __construct(AiReviewService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index(): View
    {
        return view('code-review.index');
    }

    public function review(Request $request): View
    {
        $request->validate([
            'code' => 'required_without:file|nullable|string',
            'file' => 'required_without:code|nullable|file|max:10240',
        ]);

        $code = $request->input('code');

        if ($request->hasFile('file')) {
            $code = file_get_contents($request->file('file')->getRealPath());
        }

        $review = $this->aiService->review($code);

        return view('code-review.results', [
            'review' => $review,
            'originalCode' => $code
        ]);
    }
}
