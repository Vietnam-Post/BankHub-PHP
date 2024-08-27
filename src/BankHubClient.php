<?php

namespace BankHub;

use GuzzleHttp\Client;

class BankHubClient
{
    protected $httpClient;
    protected $apiUrl;
    protected $clientId;
    protected $secretKey;
    protected $authorization;

    public function __construct($authorization = null)
    {
        $this->httpClient = new Client();

        $mode = getenv('BANKHUB_MODE') ?: 'sandbox';
        $this->apiUrl = $mode === 'production' ? 'https://production.bankhub.dev' : 'https://sandbox.bankhub.dev';
        
        $this->clientId = getenv('BANKHUB_CLIENT_ID') ?: config('bankhub.client_id');
        $this->secretKey = getenv('BANKHUB_SECRET_KEY') ?: config('bankhub.secret_key');
        
        $this->authorization = $authorization;
    }

    public function AuthCode($authorization)
    {
        $this->authorization = $authorization;
        return $this;
    }

    protected function request($endpoint, $method = 'GET', $data = [])
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'x-client-id' => $this->clientId,
            'x-secret-key' => $this->secretKey,
            'Authorization' => $this->authorization,
        ];

        $response = $this->httpClient->request($method, "{$this->apiUrl}/{$endpoint}", [
            'headers' => $headers,
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    // Grant Endpoints
    public function grantToken($data)
    {
        return $this->request('grant/token', 'POST', $data);
    }

    public function grantExchange($data)
    {
        return $this->request('grant/exchange', 'POST', $data);
    }

    public function grantInvalidate()
    {
        return $this->request('grant/invalidate', 'POST');
    }

    public function grantRemove()
    {
        return $this->request('grant/remove', 'POST');
    }

    // Identity Endpoint
    public function Identity()
    {
        return $this->request('identity');
    }

    // Balance Endpoint
    public function Balance()
    {
        return $this->request('balance');
    }

    // Transactions Endpoint
    public function Transactions($data)
    {
        return $this->request('transactions', 'GET', $data);
    }

    // QR Pay Endpoint
    public function QrPay($data)
    {
        return $this->request('qr-pay', 'POST', $data);
    }

    // Static Method Wrapper
    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        if ($name === 'AuthCode') {
            $instance->AuthCode($arguments[0]);
            return $instance;
        }
        return $instance->$name(...$arguments);
    }
}
