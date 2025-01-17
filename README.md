# Direct Pay Online API Wrapper for PHP  
[![Latest Stable Version](https://poser.pugx.org/rag/direct-pay-online-php/v)](https://packagist.org/packages/rag/direct-pay-online-php)
[![Total Downloads](https://poser.pugx.org/rag/direct-pay-online-php/downloads)](https://packagist.org/packages/rag/direct-pay-online-php)

Unofficial PHP wrapper for [Direct Pay Online API](https://directpayonline.atlassian.net/wiki/spaces/API/overview)  
  
Inspired by [dipnot/direct-pay-online-php](https://github.com/radioafricagroup/direct-pay-online-php)  

## Dependencies
- PHP 5.6.36 or higher
- ext-curl
- ext-simplexml
- ext-json
  
## Installation  
You can install via [Composer](https://getcomposer.org/).  

    composer require radioafricagroup/direct-pay-online-php

  
## Usage  
You can see the full example in [examples](https://github.com/radioafricagroup/direct-pay-online-php/tree/main/examples) folder.
### Config
All request are needs a Config.
```php  
use Rag\DirectPayOnline\Config;

$config = new Config();  
$config->setCompanyToken("9F416C11-127B-4DE2-AC7F-D5710E4C5E0A");  
$config->setTestMode(true);
```
### Transaction
```php  
use Rag\DirectPayOnline\Model\Transaction;

$transaction = new Transaction(100, "USD");
```  

### Service
```php  
use Rag\DirectPayOnline\Model\Service;

$service = new Service("Test Product", 3854, "2020/02/12 11:21");
```  
### "createToken" Request
Create a token to start payment process.  
```php  
use Rag\DirectPayOnline\Request\CreateTokenRequest;

$createTokenRequest = new CreateTokenRequest($config);  
$createTokenRequest->setTransaction($transaction);  
$createTokenRequest->addService($service1);
$createTokenRequest->addService($service2);
$createToken = $createTokenRequest->execute();  
print_r($createToken);  
``` 

### "verifyToken" Request
Get the payment result by using VerifyTokenRequest.
```php  
use Rag\DirectPayOnline\Request\VerifyTokenRequest;

$verifyTokenRequest = new VerifyTokenRequest($config);
$verifyTokenRequest->setTransactionToken($_GET["TransactionToken"]);
$verifyToken = $verifyTokenRequest->execute();
print_r($verifyToken);
```  
  
### Getting the payment URL  
Get the payment URL with the created token to redirect the user to the payment page.  
```php  
$paymentUrl = $createTokenRequest->getPaymentUrl($createToken["TransToken"]);  
print_r($paymentUrl);
```  

### Recurrent Payments  
### Step 1
Fetch subscription tokens for users.
```php  
$getSubscriptionTokenRequest = new GetSubscriptionTokenRequest($config);
$getSubscriptionTokenRequest->setSearchCriteria($searchCriteriaSearch);  
$getSubscriptionTokenRequest->setSearchCriteriaValue($searchCriteriaSearchValue);  
$getSubscriptionToken = $getSubscriptionTokenRequest->execute();  
print_r($getSubscriptionToken);
```  
  
## Test values  
You can fill the personal info randomly in the payment page.  
  
||Value|  
|--|--|  
|Company token|9F416C11-127B-4DE2-AC7F-D5710E4C5E0A|  
|Card number|5436886269848367|  
|Card expiry date (Month/Year)|12/22|  
|Card CVV|123|  
  
## License  
[![License: MIT](https://img.shields.io/badge/License-MIT-%232fdcff)](https://github.com/radioafricagroup/direct-pay-online-php/blob/main/LICENSE)
