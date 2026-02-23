<?php

namespace App\Services;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client;

class AiAnalysisService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://127.0.0.1:5001']);
    }

    /**
     * Analyze complaint text (and optionally category) with AI model.
     *
     * @param  string  $text
     * @param  string|null  $category
     * @return array
     */
    public function analyze(string $text, ?string $category = null): array
    {
        try {
            $payload = ['text' => $text];

            if ($category) {
                $payload['category'] = $category;
            }

            $response = $this->client->post('/analyze', [
                'json' => $payload,
                'timeout' => 10, // avoid hanging if API down
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            
            // Ensure ai_analysis is an array and add urgency as an alias for priority
            return [
                'sentiment' => $result['sentiment'] ?? 'neutral',
                'urgency' => $result['priority'] ?? 'medium', // Alias priority as urgency
                'confidence' => $result['confidence'] ?? 0.0,
                'category' => $result['category'] ?? 'unknown',
                'prediction' => $result['prediction'] ?? [1],
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'AI analysis failed: ' . $e->getMessage(),
            ];
        }
    }
}
