# ideenkonzept/payone

Important: This package is far from being finished.

## Installation
```
composer install ideenkonzept/payone
```

## Configuration
Add this snippet to your .env file, this way you will make sure your credintials wont be shared on your version control.

```env
PAYONE_ACCOUNT_ID=
PAYONE_MERCHANT_ACCOUNT_ID=
PAYONE_PORTAL_ID=
PAYONE_KEY=
```
## Usage

### Using Facades

```php
use Ideenkonzept\Payone\Currency;

\Payone::from($customer)->directDiebt(1.00, Currency::Euro);
```

### Normal php
```php
use Ideenkonzept\Payone\Currency;
use ideenkonzept\Payone\Payone as Client;

$payone_client = new Client();
$payone_client->from($customer)->creditCard(5.00, Currency::USDollar);
```


## Licence
This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
