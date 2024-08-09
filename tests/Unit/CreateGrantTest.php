<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class CreateGrantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testgrantToken()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/grant/token' => Http::response(['success' => true], 200),
        ]);

        // Act
        $response = $client->grantToken(['data' => 'test']);

        // Assert
        $this->assertTrue($response['success']);
    }
}
