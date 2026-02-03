<?php

namespace App\Services;

class MockAiReviewService implements AiReviewService
{
    public function review(string $code, ?string $language = null): string
    {
        return "# AI Review (Mock)\n\nThe code looks syntactically correct, but here are some suggestions:\n\n1. Consider adding type hints.\n2. Ensure error handling is robust.\n3. Add comments for complex logic.\n\nCode analyzed:\n```\n" . mb_strimwidth($code, 0, 100, "...") . "\n```";
    }
}
