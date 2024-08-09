<?php

namespace BankHub\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tkien\BankHub\BankHubClient;
use Illuminate\Support\Facades\Http;

class GetTransactionsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the HTTP client
        Http::fake();
    }

    public function testGetTransactions()
    {
        // Arrange
        $client = new BankHubClient();

        // Setup mock response
        Http::fake([
            'https://sandbox.bankhub.dev/transactions' => Http::response(['transactions' => []], 200),
        ]);

        // Act
        $response = $client->Transactions([
            'fromDate' => date('YYYY-MM-DD'),
            'toDate' => date('YYYY-MM-DD'),
        ]);

        // Assert
        $this->assertIsArray($response['transactions']);
    }
}
