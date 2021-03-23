# PHP Ad Validator Class: test Ad Tags, HTML5 Zip Ads and VAST Ads

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


## Basic Examples

### Scan an HTML5 Zip Ad
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanZip("/path/to/file.zip");
var_dump($array);
```

### Scan an Ad Tag
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
var_dump($array);
```

### Scan a VAST tag
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanVAST("https://raw.githubusercontent.com/InteractiveAdvertisingBureau/VAST_Samples/master/VAST%203.0%20Samples/Inline_Companion_Tag-test.xml");
var_dump($array);
```

## Some other examples
Ad servers like Google Ad Manager usually scan a creative to make sure it's SSL-compatible. To do so, use this example:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$ssl_compatible = $array['ssl_compatible']; //boolean
```

To get a **preview** of an ad tag, use this example:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$preview_image = file_get_contents($array['screenshot']['highres']['url']); //holds image in binary format
```

To create a **backup ad** for a HTML5 Zip Ad:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanZip("/path/to/file.zip");
$backup_ad = file_get_contents($array['screenshot']['highres']['url']); //holds image in binary format
```

To check if a creative **drops third-party cookies**:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$drops_cookies = (count($array['cookies'])>0); //boolean
```

To get the **dimensions** of an ad tag:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$width = $array['dimensions']['width']; //int
$height = $array['dimensions']['height']; //int
```

To get the **CPU usage** of a HTML5 Zip Ad:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanZip("/path/to/file.zip");
$cpu_usage = $array['cpu_usage']; //in milliseconds
```

To get the **memory usage** of a HTML5 Zip Ad:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanZip("/path/to/file.zip");
$cpu_usage = $array['memory_usage']; //in bytes
```

To get the **all network requests** of an ad tag:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$network = $array['network']; //an array with lots of interesting data
```

To check if an ad tag STILL **uses document.write()**, even though we're in the year 2021:
```php
include('CreativeQA.php');
$CreativeQA = new CreativeQA();
$array = $CreativeQA->scanTag("This is an ad tag...");
$network = $array['uses_document_write']; //boolean
```

## Full API Documentation
See here: https://www.creativeqa.io/api-docs

## API Pricing
The API at CreativeQA.io can be used *free of charge*, even for commercial products. A Fair-Use-Policy applies.

## Help & Support
If you need further help integrating these APIs in your platform, feel free to reach out:

https://www.creativeqa.io/contact
