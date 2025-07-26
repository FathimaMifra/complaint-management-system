<?php

namespace App\Services;

use GuzzleHttp\Client;

class AiAnalysisService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:5001']);
    }

    public function analyze($text)
    {
        try {
            $response = $this->client->post('/analyze', [
                'json' => ['text' => $text]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => 'AI analysis failed: ' . $e->getMessage()];
        }
    }
}
