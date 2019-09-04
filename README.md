# Very short description of the package

<!--[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/php-tika.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)-->
<!--[![Build Status](https://img.shields.io/travis/spatie/php-tika/master.svg?style=flat-square)](https://travis-ci.org/spatie/:package_name)-->
<!--[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/php-tika.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/:package_name)-->
<!--[![Total Downloads](https://img.shields.io/packagist/dt/spatie/php-tika.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)-->

A PHP package to provide document parsing functionality to PHP.

Takes a file path with the file stored locally on the server and convert 
it to plain text for further processing inside of PHP.

File types such as PDF, Microsoft Word `.docx`, Microsoft Outlook `.msg`
 files are just some examples of use cases that this package has been
 used to parse.

## Installation

You can install the package via composer:

```bash
composer require hgflimited/php-tika
```

## Usage

We use [this](https://github.com/LexPredict/tika-server) docker
container for local testing as it already has a Tesseract enabled for
OCR.

``` php
$tika = new Tika('mytikaserver', '9998');
$metaResponse = $tika->addDocument($document->getFullFilename())
                    ->tika()
                    ->ocr()
                    ->get();
```

This package was designed to work well with the Framework niceties
that Laravel provides, but can also exist in a traditional PHP 
application.

The Default Implementation of the Document Parser is to use the TikaHttp
client, which uses Guzzle to send HTTP requests to a Tika JAXRS server.

However we do provide interfaces that can be used to reduce the
 coupling and allow for dependency inversion. 

In principle it should be possible to provide a local implementation of
Tika using the Cli instead of the using HTTP if that is a better use case for 
you. If that is the case, I would suggest looking into Symfony Console 
class.  Pull requests welcome. 

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [HGF Limited](https://github.com/hgflimited)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
