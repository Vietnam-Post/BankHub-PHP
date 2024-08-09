<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class RemoveGrantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testgrantRemove()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/grant/remove' => Http::response(['status' => 'removed'], 200),
        ]);

        // Act
        $response = $client->grantRemove('grant_code');

        // Assert
        $this->assertEquals('removed', $response['status']);
    }
}
