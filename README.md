Curl
====

*Php request builder*

* Download the package

```php
// WITH GITHUB
git clone https://github.com/404NotFoundError/curl.git

// WITH COMPOSER
composer require adebayo/curl
```

* Instantiate an object curl

```php
require 'vendor/autoload.php';

$uri = "http://jservice.io//api/categories"

$request = new Adebayo\Curl($uri);
```

* Add a method

```php
// Method can be GET, POST, PUT, PATCH, DELETE
$request->setMethod('GET');
```

* Custom headers

```php

There are two ways to customize the headers

/* First way */
$request->addHeader('Content-Type:application/json');
// ..... code  
$request->addHeader('charset=UTF-8');

/* Second way */
$request->setHeader([
  'Content-Type:application/json',
  'charset=UTF-8'
]);

```

* Get the answer from the request

```php
$response = $request->getResponse();
```





