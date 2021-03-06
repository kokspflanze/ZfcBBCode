# ZfcBBCode
Zendframework Module to convert BBCode to HTML

Master
[![Build Status](https://travis-ci.org/kokspflanze/ZfcBBCode.svg?branch=master)](https://travis-ci.org/kokspflanze/ZfcBBCode?branch=master)
[![Coverage Status](https://coveralls.io/repos/kokspflanze/ZfcBBCode/badge.svg?branch=master)](https://coveralls.io/r/kokspflanze/ZfcBBCode?branch=master)

## SYSTEM REQUIREMENTS

requires PHP 7.1 or later.

## INSTALLATION

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
php composer.phar require kokspflanze/zfc-bbcode
```

Then add `ZfcBBCode` to your `config/application.config.php`.

Installation without composer is not officially supported and requires you to manually install all dependencies
that are listed in `composer.json`

## HTML-BBCode-Editor

We recommend to use [www.sceditor.com](https://www.sceditor.com).

## Feature

- ViewHelper

```php
	<?= $this->bbCodeParser('foobar') ?>
```

- ValidatorClass => `[ZfcBBCode\Validator\BBCodeValid](https://github.com/kokspflanze/ZfcBBCode/blob/master/src/ZfcBBCode/Validator/BBCodeValid.php)` 