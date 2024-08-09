<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class InvalidateGrantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testgrantInvalidate()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/grant/invalidate' => Http::response(['status' => 'invalidated'], 200),
        ]);

        // Act
        $response = $client->grantInvalidate('grant_code');

        // Assert
        $this->assertEquals('invalidated', $response['status']);
    }
}
