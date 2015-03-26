=================
Welcome to Wunderlist PHP SDK
=================

What is it?
============

This is the unofficial Wunderlist SDK for PHP!!

The Wunderlist API provides REST-based storage and synchronization of a user’s lists across multiple
platforms and devices. The primary things you’ll need to use it are an understanding of our data model,
how we version individual entities in a user’s data, the formats we use for transmission, and a set
of OAuth credentials.

The PHP SDK helps you to interact with this API.

Installation
============

The recommended way to install Wunderlist PHP SDK is with `Composer <http://getcomposer.org>`_. Composer is a dependency
management tool for PHP that allows you to declare the dependencies your project needs and installs them into your
project.

.. code-block:: bash

    # Install Composer
    curl -sS https://getcomposer.org/installer | php

You can add Wunderlist PHP SDK as a dependency using the composer.phar CLI:

.. code-block:: bash

    php composer.phar require italolelis/wunderist

Alternatively, you can specify Wunderlist PHP SDK as a dependency in your project's
existing composer.json file:

.. code-block:: js

    {
      "require": {
         "italolelis/wunderist": "~1.0"
      }
   }

After installing, you need to require Composer's autoloader:

.. code-block:: php

    require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and
other best-practices for defining dependencies at `getcomposer.org <http://getcomposer.org>`_.

Bleeding edge
-------------

During your development, you can keep up with the latest changes on the master
branch by setting the version requirement for Wunderlist PHP SDK to ``~1.0@dev``.

.. code-block:: js

   {
      "require": {
         "italolelis/wunderist": "~4.0@dev"
      }
   }

License
=======

Licensed using the `MIT license <http://opensource.org/licenses/MIT>`_.

    The MIT License (MIT)

    Copyright (c) 2013 italolelis <italolelis@gmail.com>

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.

Contributing
============

Guidelines
----------

1. Wunderlist PHP SDK follows PSR-0, PSR-1, and PSR-2.
2. Wunderlist PHP SDK is meant to be lean and fast with very few dependencies.
3. Wunderlist PHP SDK has a minimum PHP version requirement of PHP 5.5. Pull requests must
   not require a PHP version greater than PHP 5.5.
4. All pull requests must include unit tests to ensure the change works as
   expected and to prevent regressions.

Running the tests
-----------------

In order to contribute, you'll need to checkout the source from GitHub and
install Collection's dependencies using Composer:

.. code-block:: bash

    git clone https://github.com/italolelis/wunderlist.git
    cd wunderlist && curl -s http://getcomposer.org/installer | php && ./composer.phar install --dev

Wunderlist PHP SDK is unit tested with PHPUnit. Run the tests using the vendored PHPUnit
binary:

.. code-block:: bash

    vendor/bin/phpunit