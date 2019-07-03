basster/twig-base64-extension
=============================

[![SymfonyInsight](https://insight.symfony.com/projects/b44a3032-735a-4659-9077-d32393efa623/mini.svg)](https://insight.symfony.com/projects/b44a3032-735a-4659-9077-d32393efa623) [![Build Status](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/build-status/master) [![Code Coverage](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Basster/twig-base64-extension/?branch=master)

Install
-------

```bash
composer req basster/twig-base64-extension
```

Use in Symfony
--------------

If you are using [Symfony Flex](https://flex.symfony.com/) you're done.

If you are not using Flex, add the following to your `services.yaml`:

```yaml
services:
  _defaults:
    public: false
    autowire: true
    autoconfigure: true

  Basster\TwigBase64\Converter\ImageToBase64Converter: ~
  Basster\TwigBase64\Twig\Base64ImageExtension: ~
  Basster\TwigBase64\Converter\FileConverterInterface: '@Basster\TwigBase64\Converter\ImageToBase64Converter'
```

If you are using Twig standalone, do something like this:

```php
$converter = new \Basster\TwigBase64\Converter\ImageToBase64Converter(new \Symfony\Component\Serializer\Normalizer\DataUriNormalizer());
$extension = new \Basster\TwigBase64\Twig\Base64ImageExtension($converter);

$twig = new \Twig\Environment($loader);
$twig->addExtension($extension);
```

Usage
------

```twig
<img src="{{ 'img/logo.svg' | image64 }}" alt="My awesome logo" />
```

Supported Mime-Types?
---------------------
It utilizes Symfonys `MimeTypeGuesser`, nuff said. 
