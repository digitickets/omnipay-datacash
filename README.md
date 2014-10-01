# Omnipay: DataCash

**DataCash driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/coatesap/omnipay-datacash.png?branch=master)](https://travis-ci.org/omnipay/datacash)
[![Latest Stable Version](https://poser.pugx.org/coatesap/omnipay-datacash/version.png)](https://packagist.org/packages/omnipay/datacash)
[![Total Downloads](https://poser.pugx.org/coatesap/omnipay-datacash/d/total.png)](https://packagist.org/packages/coatesap/omnipay-datacash)

This driver supports the remote DataCash Payment Gateway (DPG) service. Payment information is sent and received via XML messages. Customers typically stay on the originating website with this method of integration.

## Installation

The DataCash Omnipay driver is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "coatesap/omnipay-datacash": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

This driver supports two transaction types:
 * Purchase (including 3D Secure support if card holder is registered)
 * Refund (you will need to send DataCash's reference from the original transaction as the 'transactionReference' parameter.)

For general Omnipay usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug in this driver, please report it using the [GitHub issue tracker](https://github.com/omnipay/datacash/issues),
or better yet, fork the library and submit a pull request.
