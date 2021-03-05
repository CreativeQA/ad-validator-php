# PHP Ad Validator Class: test Ad Tags, HTML5 Zip Ads and VAST Video Ads

This PHP uses the API from [CreativeQA.io](https://www.creativeqa.io) to analyze the ads. It returns an array of metrics, like:

* CPU usage
* Load size in bytes
* Load speed in ms
* Network requests
* SSL-compatibility
* Third-party cookies
* Ad dimensions (width/height)
* Plays video (boolean)
* If blocked by adblock
* ...and much more!

## Ad formats
This PHP class supports the following ad formats:

* Ad Tags
* HTML5 Zip Ads
* VAST Video Ads

## Preparation
Request a free API key via https://www.creativeqa.io/html5-ad-validator - you'll get an API key and your endpoint emailed within minutes. Download the PHP class from this repository and paste your **endpoint** and **API Key** in the two variables at the top of the class.

## Methods
```php
$array = scanZip($filename);
$array = scanTag($tag);
$array = scanVAST($url);
```

## Examples
```php
include('CreativeQA.php');
$array = scanTag("This is an ad tag...");
var_dump($array);
```

[GitHub](http://github.com)
