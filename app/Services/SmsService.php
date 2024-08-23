<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $apiKey;
    protected $baseUrl = 'https://sms.ru/sms/send'; // Ensure this is the correct endpoint

    public function __construct()
    {
        $this->apiKey = "87BB656F-F9CC-79C4-E167-834165F31EE2";
    }
    
    public function sendSms($phone, $message)
    {
        // Replace the 'json' parameter with the correct one if needed
        $response = Http::post($this->baseUrl, [
            'api_id' => $this->apiKey,
            'to' => $phone,
            'msg' => $message,
            'json' => 1, // This parameter might not be needed. Check API documentation.
        ]);
    
        Log::info('SMS API response', [
            'body' => $response->body(),
            'status' => $response->status(),
            'headers' => $response->headers()
        ]);
    
        $responseBody = $response->json();
    
        if ($response->failed()) {
            Log::error('SMS API error', [
                'response' => $responseBody,
                'status_code' => $response->status(),
                'reason' => $response->reason()
            ]);
            return ['status' => 'ERROR', 'message' => $response->reason()];
        }
    
        return $responseBody;
    }
}
