# String Encoder

String Encode is a PHP is a simple, flexible, package with the goal of assisting developers with handling MB strings and encodings.

## Install

Install the latest version using composer.

```bash
$ composer require devanoxltd/string-encode
```

## Basic Usage

```php
<?php

use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in UTF-8 encoding (default)
```

## Documentation

- [Encoding](docs/encoding.md)
- [Regex](docs/regex.md)

## About

### Requirements

- String Encoder works with PHP 7.2, 7.3, and 7.4.

### Submitting bugs and feature requests

Bugs and feature requests are tracked on [GitHub](https://github.com/devanoxltd/string-encoder/issues)

### Authors

Gilles Paquette
See also the list of [contributors](https://github.com/devanoxltd/string-encoder/contributors) who participated in this project.

### License
String Encode is licensed under the MIT License - see [LICENSE](LICENSE.md) file for details.

### Credit
This is forked from [paquettg/string-encoder](https://github.com/paquettg/string-encoder)