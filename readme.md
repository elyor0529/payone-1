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


### Low level client

```php
$payone = new Client();
$response = $payone->request( [
    'firstname'       => 'John',
    'lastname'        => 'Snow',
    'street'          => 'Black Castel',
    'zip'             => '00110',
    'city'            => 'Winterfell',
    'country'         => 'DE',
    'email'           => 'john@winterfell.north',
    'telephonenumber' => '2233665588',
    'amount'          => 1000,
    'currency'        => 'EUR',
    'iban'            => 'DE85123456782599100003',
    'bic'             => 'TESTTEST',
    'request'         => 'authorization',
    'clearingtype'    => 'elv',
    'reference'       => uniqid()
] );
```

### Payone builder
We also provide a cool request builder, with a fluent api.

```php
$customer = [
    'firstname'       => 'John',
    'lastname'        => 'Snow',
    'street'          => 'Black Castle',
    'zip'             => '00110',
    'city'            => 'Winterfell',
    'country'         => 'DE',
    'email'           => 'john@winterfell.north',
    'telephonenumber' => '2233665588',
];


$payone = new Payone();

$response = $payone->customer( $customer )
                    ->directDebit( [ 'iban' => 'DE85123456782599100003', 'bic' => 'TESTTEST' ] )
                    ->authorize( $amount = 10, $currency = null, uniqid() );
                    
```
OR
```php
$response = $payone->customer( $customer )
                   ->creditCard( Card::Visa, [
                       'cardpan'        => '4111111111111111',
                       'cardcvc2'       => '123',
                       'cardexpiredate' => '2010',
                   ] )->authorize( $amount = 45 );

```

### Using Facades

```php
use Ideenkonzept\Payone\Currency;

\Payone::from($customer)->directDiebt(1.00, Currency::Euro);
```

## Licence
This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
