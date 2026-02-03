<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class OpenAiReviewService implements AiReviewService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->model = config('services.openai.model', 'gpt-4o');
        $this->baseUrl = config('services.openai.base_url', 'https://api.openai.com/v1');
    }

    public function review(string $code, ?string $language = null): string
    {
        if (empty($this->apiKey)) {
            return "## Configuration Error\n\nOpenAI API Key is missing. Please set `OPENAI_API_KEY` in your `.env` file.";
        }

        $prompt = "You are an expert code reviewer. Review the following code for best practices, bugs, security vulnerabilities, and performance. 
Make your response concise and formatted in Markdown.
If the language is provided ($language), specificy linting rules for that language.

Code to review:
```
$code
```
";

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(60)
                ->post("$this->baseUrl/chat/completions", [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system', 
                            'content' => 'You are a helpful and strict code review assistant.'
                        ],
                        [
                            'role' => 'user', 
                            'content' => $prompt
                        ],
                    ],
                    'temperature' => 0.7,
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API Error', ['body' => $response->body()]);
                return "## API Error\n\nFailed to communicate with OpenAI. " . $response->json('error.message', 'Unknown error.');
            }

            return $response->json('choices.0.message.content') ?? 'No review generated.';

        } catch (\Exception $e) {
            Log::error('OpenAI Connection Error', ['message' => $e->getMessage()]);
            return "## Connection Error\n\nCould not connect to OpenAI API: " . $e->getMessage();
        }
    }
}
