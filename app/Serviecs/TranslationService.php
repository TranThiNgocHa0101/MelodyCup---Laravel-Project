<?php

namespace App\Services;

use GuzzleHttp\Client;
use Laravel\Prompts\Clear;

class TranslationService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = new Client();
    }

    /**
     * Dịch văn bản từ ngôn ngữ nguồn sang ngôn ngữ đích
     *
     * @param string $text - Văn bản cần dịch
     * @param string $sourceLang - Ngôn ngữ nguồn
     * @param string $targetLang - Ngôn ngữ đích
     * @return string
     */
    public function translate(string $text, string $sourceLang = 'en', string $targetLang = 'vi')
    {
        $url = 'https://libretranslate.com'; // API endpoint của LibreTranslate

        try {
            $response = $this->client->post($url, [
                'form_params' => [
                    'q' => $text,
                    'source' => $sourceLang,
                    'target' => $targetLang,
                    'format' => 'text'
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return $body['translatedText'] ?? ''; // Trả về văn bản đã dịch

        } catch (\Exception $e) {
            return 'Lỗi khi dịch: ' . $e->getMessage();
        }
    }
}
