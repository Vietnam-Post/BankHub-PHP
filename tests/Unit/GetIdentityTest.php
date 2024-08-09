<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class GetIdentityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testGetIdentity()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/identity' => Http::response(['identity' => '12345'], 200),
        ]);

        // Act
        $response = $client->Identity();

        // Assert
        $this->assertEquals('12345', $response['identity']);
    }
}
