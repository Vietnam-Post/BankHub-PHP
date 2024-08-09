<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class ExchangeGrantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testgrantExchange()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/grant/exchange' => Http::response(['token' => 'abc123'], 200),
        ]);

        // Act
        $response = $client->grantExchange('grant_code');

        // Assert
        $this->assertEquals('abc123', $response['token']);
    }
}
