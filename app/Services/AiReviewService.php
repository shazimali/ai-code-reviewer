<?php

namespace App\Services;

interface AiReviewService
{
    /**
     * Analyze the provided code and return suggestions.
     *
     * @param string $code
     * @param string|null $language
     * @return string Markdown formatted review
     */
    public function review(string $code, ?string $language = null): string;
}
