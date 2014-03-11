cart
=================

[![Build Status](https://secure.travis-ci.org/leaphly/cart.png?branch=master)](http://travis-ci.org/leaphly/cart) [![Total Downloads](https://poser.pugx.org/leaphly/cart/downloads.png)](https://packagist.org/packages/leaphly/cart) [![Latest Stable Version](https://poser.pugx.org/leaphly/cart/v/stable.png)](https://packagist.org/packages/leaphly/cart)

#### This library is far from complete, at least the tests are green.

Mission-statement
----------


The Leaphly project makes it easier for developers to add cart functionality to the Symfony2 applications or to those applications that could consume REST API.

This software provides the tools and guidelines for building decoupled, high-quality and long-life e-commerce applications.

[continue reading on the website](http://leaphly.org)

Demo
----

[demo](http://leaphly.org/#demo)

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Test
----

``` bash
composer.phar create-project leaphly/cart`
vendor/bin/phpunit
```

All the Functional testing are into the [leaphly-sandbox](https://github.com/leaphly/leaphly-sandbox).

About
-----

Cart is a [leaphly](https://github.com/leaphly) initiative.
See also the list of [contributors](https://github.com/leaphly/cart/contributors).

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/leaphly/cart/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the library to reproduce the issue by simply cloning it
and following some steps.


TODO
-----

- Better usage of the finite transitions.

- Add more DB drivers

