<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class CreateQrPayTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testCreateQrPay()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/qr-pay' => Http::response(['qr_code' => 'qr123'], 200),
        ]);

        // Act
        $response = $client->QrPay(['amount' => 100]);

        // Assert
        $this->assertEquals('qr123', $response['qr_code']);
    }
}
