============
Integrations
============

Silex
=====

We have a silex provider for you to use with your Silex application.
It's important to configure the authenticator in your silex application.

.. code-block:: bash

    php composer.phar require gigablah/silex-oauth
    php composer.phar require italolelis/wunderist-provider

Lets register *silex-oauth* and *wunderist-provider*:

.. code-block:: php

    // app.php
    $app->register(new Gigablah\Silex\OAuth\OAuthServiceProvider());
    $app->register(new Wunderlist\Silex\Provider\WunderlistServiceProvider());

Configure both services:

.. code-block:: php

    // config/prod.php
    $app['oauth.services'] = [
        'wunderlist' => [
            'class' => 'Wunderlist\OAuth\Service\Wunderlist',
            'key' => 'yourClientID',
            'secret' => 'yourClientSecret',
            'scope' => array(),
            'user_endpoint' => 'https://a.wunderlist.com/api/v1/user'
        ]
    ];

    // This is not necessary, but it's good for the login with wunderlist funcionality
    $app['security.firewalls'] = array(
        'default' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'oauth' => array(
                //'login_path' => '/auth/{service}',
                //'callback_path' => '/auth/{service}/callback',
                //'check_path' => '/auth/{service}/check',
                'failure_path' => '/',
                'with_csrf' => true
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'with_csrf' => true
            ),
            'users' => new Gigablah\Silex\OAuth\Security\User\Provider\OAuthInMemoryUserProvider()
        )
    );

    $app['security.access_rules'] = array(
        array('^/auth', 'ROLE_USER')
    );

In your controllers:

.. code-block:: php

        $wunderlist = $app['wunderlist'];
        $listsService = $wunderlist->getLists();

Skeleton App
------------

We develop a skeleton app which is already configured for you. Just run:

.. code-block:: bash

    php composer.phar create-project italolelis/silex-skeleton-wunderlist your/path/


Symfony
=======

Use symfony? Don't worry, we have a Bundle for Wunderlist SDK too!

.. code-block:: bash

    php composer.phar require italolelis/wunderist-bundle

Just register the bundle and access the SDK:

.. code-block:: php

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Wunderlist\WunderlistBundle(),
        );
    }

Configure:

.. code-block:: yaml

    # app/config/config.yml
    wunderlist:
        credentials:
            clientId: yourClientID
            clientSecret: yourClientSecret
            redirectUri: http://domain.com/oauth/callback

In your controllers:

.. code-block:: php

        $wunderlist = $this->get('wunderlist');
        $listsService = $wunderlist->getLists();