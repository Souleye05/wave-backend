<?php

namespace App\Services;

use GuzzleHttp\Client;

class SmsService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;
    protected $from;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('INFOBIP_API_KEY');
        $this->baseUrl = env('INFOBIP_BASE_URL');
        $this->from = env('INFOBIP_FROM');
    }

    public function sendSms($to, $message)
    {
        try {
            $response = $this->client->post("{$this->baseUrl}/sms/2/text/advanced", [
                'headers' => [
                    'Authorization' => 'App ' . $this->apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'messages' => [
                        [
                            'from' => $this->from,
                            'destinations' => [
                                ['to' => $to],
                            ],
                            'text' => $message,
                        ],
                    ],
                ],
            ]);

            // Si tu veux voir la réponse de l'API, tu peux la décommenter
            // $responseBody = $response->getBody()->getContents();
            // return json_decode($responseBody);

        } catch (\Exception $e) {
            // Log the error if needed
            return null;
        }
    }
}
