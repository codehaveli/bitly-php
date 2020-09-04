

# Bitly PHP SDK by Codehaveli

* [Description](#description)
* [Installation](#installation)
* [Usage](#usage)
	* [Link](#link)
* [Terms of Use](#terms-of-use)
* [Other Resource](#other-resource)



### Description

A PHP wrapper for the bit.ly API. This package use Bitly API version v4.

### Installation

Install via composer

`composer require codehaveli/bitly-php:dev-master --prefer-source`

### Usage

```php
<?php

require 'vendor/autoload.php';

use Codehaveli\Bitly;
use Codehaveli\Exceptions\BitlyErrorException;

// First setup your credentials provided by bilty

$accessToken  = "ACCESS_TOKEN_FROM_BITLY";
$guid         = "GUID_FROM_BITLY";

Bitly::init($accessToken, $guid);
```

Once credentials are set you can use available resources.

Resources availables:

- **Link** 
  * Available methods: `getUrl`




#### Link

```php
<?php

use Codehaveli\Bitly;
use Codehaveli\Exceptions\BitlyErrorException;

Bitly::init($access_token, $guid);

$link = Bitly::link();

try {

	$shortLink = $link->getUrl("https://www.codehaveli.com/");  // https://bit.ly/3lF0yKR

} catch (BitlyErrorException $e) {

	$code    = $e->getCode();
	$message = $e->getMessage();
}
```

### Terms of Use
 
This is not a Official SDK of Bitly
Please read [privacy](https://bitly.com/pages/privacy) and [terms of service](https://bitly.com/pages/terms-of-service) of [Bitly](https://bitly.com/) before use.
### Other Resource
1. Wordpress Plugin by Codehaveli [Codehaveli Bitly URL Shortener](https://bit.ly/codehaveli-bitly-url-shortener) 
2. [Bitly API Documentation](https://dev.bitly.com/)
3. [Codehaveli Blog](https://www.codehaveli.com/blogs/)
