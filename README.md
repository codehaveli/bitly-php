
# Bitly PHP SDK by Codehaveli

### Installation

Install via composer (not hosted in packagist yet)

`composer require codehaveli/bitly-php`

## Usage

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
Please read [privacy](https://bitly.com/pages/privacy) and [terms of service](https://bitly.com/pages/terms-of-service) of [Bitly](https://bitly.com/) before using this plugin.
### Other Resource
1. Wordpress Plugin [Codehaveli Bitly URL Shortener](https://bit.ly/codehaveli-bitly-url-shortener) 
