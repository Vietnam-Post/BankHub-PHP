# BankHub PHP Package
A PHP package for BankHub API integration.

## Author
Kiên Nguyễn

## Installation
To install the package, run the following command:
```bash
composer require vnpost/bankhub
```

## Configuration
### Step 1: Publish Configuration
Publish the configuration file using the following command:
```bash
php artisan vendor:publish --provider="Tkien\BankHub\BankHubServiceProvider"
```

### Step 2: Update .env File
Add the following variables to your .env file:
```bash
BANKHUB_MODE=sandbox
BANKHUB_CLIENT_ID=your-client-id
BANKHUB_SECRET_KEY=your-secret-key
```

## Step 3: How to use?
Option 1:
```bash
use BankHub\BankHubClient;

$response = BankHubClient::AuthCode('your-authorization-code')->grantToken($data);
```
Option 2:
```bash
use BankHub\BankHubClient;

$client = new BankHubClient();
$client->AuthCode('your-authorization-code');
$response = $client->grantToken($data);
```
Option 3:
```bash
use BankHub\BankHubClient;

$client = new BankHubClient('your-authorization-code');
$response = $client->grantToken($data);
```

### List of available functions
> 1. grantToken
> 2. grantExchange
> 3. grantInvalidate
> 4. grantRemove
> 5. Identity
> 6. Balance
> 7. Transactions
> 8. QrPay

Chi tiết xem tại [https://bankhub.dev/general/api](https://bankhub.dev/general/api)

## License
This package is open-sourced software licensed under the [Apache-2.0](https://www.apache.org/licenses/LICENSE-2.0) license.
