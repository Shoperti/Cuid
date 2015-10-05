# Shoperti Cuid

[![Build Status](https://travis-ci.org/Shoperti/Cuid.svg?branch=master)](https://travis-ci.org/Shoperti/Cuid)
[![StyleCI](https://styleci.io/repos/43709599/shield)](https://styleci.io/repos/43709599)

This is a port from https://github.com/ericelliott/cuid to PHP. Please refer to the original repo for more information.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `shoperti/cuid`.

```json
"require": {
  "shoperti/cuid": "~1.0"
}
```

Next, update Composer from the Terminal:

    composer update

### Examples

```php
// Create a new cuid
$cuid = new Shoperti\Cuid\Cuid::cuid();

// Create a new cuid slug
$cuid = new Shoperti\Cuid\Cuid::slug();
```
