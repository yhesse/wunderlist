<?php

namespace Wunderlist\Provider;

use League\OAuth2\Client\Entity\User;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class Wunderlist extends AbstractProvider
{
    public $scopes = [];
    public $responseType = 'json';
    public $authorizationHeader = true;
    public $version = 'v1';

    protected function getAuthorizationHeaders($token)
    {
        $headers = [];
        if ($this->authorizationHeader) {
            $headers['X-Client-ID'] = $this->clientId;
            $headers['X-Access-Token'] = $token;
        }
        return $headers;
    }

    /**
     * Get the URL that this provider uses to begin authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return 'https://www.wunderlist.com/oauth/authorize';
    }

    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return 'https://www.wunderlist.com/oauth/access_token';
    }

    /**
     * Get the URL that this provider uses to request user details.
     *
     * Since this URL is typically an authorized route, most providers will require you to pass the access_token as
     * a parameter to the request. For example, the google url is:
     *
     * @param AccessToken $token
     * @return string
     */
    public function urlUserDetails(AccessToken $token)
    {
        return 'https://a.wunderlist.com/api/v1/user';
    }

    /**
     * Given an object response from the server, process the user details into a format expected by the user
     * of the client.
     *
     * @param object $response
     * @param AccessToken $token
     * @return mixed
     */
    public function userDetails($response, AccessToken $token)
    {
        $user = new User();
        $user->exchangeArray([
            'uid' => $response->id,
            'name' => $response->name,
            'firstname' => $response->name,
            'email' => $response->email,
            'createdAt' => $response->created_at,
        ]);
        return $user;
    }

    public function userUid($response, AccessToken $token)
    {
        return $response->id;
    }

    public function userEmail($response, AccessToken $token)
    {
        return $response->email;
    }

    public function userScreenName($response, AccessToken $token)
    {
        return $response->name;
    }
}