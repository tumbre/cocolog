<?php

namespace App\Services;

use Google\Cloud\Language\LanguageClient;

class SentimentAnalysisService
{
    public function analyzeSentiment($text)
    {
        $projectId = 'cocolog';
        $language = new LanguageClient([
            'projectId' => $projectId,
            'keyFile' => [
                "type" => env('TYPE'),
                "project_id" => env('PROJECT_ID'),
                "private_key_id" => env('PRIVATE_KEY_ID'),
                "private_key" => str_replace('\\n', "\n",env('PRIVATE_KEY')),
                "client_email" => env('CLIENT_EMAIL'),
                "client_id" => env('CLIENT_ID'),
                "auth_uri" => env('AUTH_URI'),
                "token_uri" => env('TOKEN_URI'),
                "auth_provider_x509_cert_url" => env('AUTH_PROVIDER_X509_CERT_URL'),
                "client_x509_cert_url" => env('CLIENT_X509_CERT_URL'),
                "universe_domain" => env('UNIVERSE_DOMAIN')
            ]
        ]);

        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();

        // スコアが0だと棒グラフに表示されなくなるため5を代入。チャートでは色を透明にして表示。
        $score = ($sentiment['score'] == 0) ? 5 : $sentiment['score'] * 100;
        $magnitude = $sentiment['magnitude'] * 10;

        return compact('score', 'magnitude');
    }
}
