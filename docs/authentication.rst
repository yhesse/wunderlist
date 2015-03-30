==============
Authentication
==============

The Wunderlist API uses OAuth2 to allow external applications to request authorization
to a user’s Wunderlist account without directly handling their password.
Developers must register their application before getting started. Registration assigns
a unique client ID and client secret for your application’s use. After you have registered
your application, you can let Wunderlist users authorize access to their account information
from your application by getting an access token.
After a user has authorized your application and you have an access token, you can use it
in Wunderlist API requests by setting the X-Client-ID and X-Access-Token HTTP request headers.

Our SDK handles this procedure very well. For this we have a some simple steps to make.
Just remeber that this procedure is already done by our SDK, this is just an stand alone service
if you want to use it.

.. code-block:: php
    // This is necessary for PHPoAuthLib authentication
    $credentials = new Credentials(
        'yourClientId',
        'yourClientSecret',
        'http://domain.com/oauth/callback'
    );

    //The factory is responsible for the service contruction
    $facotry = new ServiceFactory();

    //This is where we're going to storage the access_token
    $session = new Session();

    // Now it's time to create the service
    $service = $facotry->createService('wunderlist', $credentials, $session);

    // We need to create a request to handle the authorization procedure
    $request = Request::createFromGlobals();
    $wunderlistAuthenticator = new OAuthLibAuthentication($service, $request);

    //We ask for the user's authorization, this will make a redirect to the authorization view and then
    // redirects to your redicretUri. The redirectUri need to have this call again to handle the rest
    // of the flow
    $access_token = $wunderlistAuthenticator->authorize();

Built in Providers
------------------

`PHPoAuthLib <https://github.com/Lusitanian/PHPoAuthLib>`_

PHPoAuthLib provides oAuth support in PHP 5.3+ and is very easy to integrate with any project which
requires an oAuth client.

`oauth2-client <https://github.com/thephpleague/oauth2-client>`_

This package makes it stupidly simple to integrate your application with OAuth 2.0 identity providers.

Custom Providers
----------------

You can implement any provider by implementing the *AuthenticationInterface*

.. code-block:: php

    use Wunderlist\OAuth\AuthenticationInterface;
    use Symfony\Component\HttpFoundation\Request;

    class MyProviderAuthentication implements AuthenticationInterface
    {
        /**
         * @return Request
         */
        public function getRequest()
        {

        }

        /**
         * @param Request $request
         * @return $this
         */
        public function setRequest($request)
        {

        }

        /**
         * @return string
         */
        public function getConsumerId()
        {

        }

        /**
         * @return string
         */
        public function getAccessToken()
        {

        }

        /**
         * @return string
         */
        public function hasAccessToken()
        {

        }

        public function authorize()
        {

        }
    }
