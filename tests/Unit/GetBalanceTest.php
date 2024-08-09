<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class GetBalanceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testGetBalance()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/balance' => Http::response(['balance' => 1000], 200),
        ]);

        // Act
        $response = $client->Balance();

        // Assert
        $this->assertEquals(1000, $response['balance']);
    }
}
