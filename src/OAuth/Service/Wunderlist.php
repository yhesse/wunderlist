<?php

namespace Wunderlist\OAuth\Service;

use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Http\Uri\UriInterface;
use OAuth\Common\Token\TokenInterface;
use OAuth\OAuth2\Service\AbstractService;
use OAuth\OAuth2\Token\StdOAuth2Token;

class Wunderlist extends AbstractService
{

    public function getConsumerId()
    {
        return $this->credentials->getConsumerId();
    }

    /**
     * Parses the access token response and returns a TokenInterface.
     *
     *
     * @param string $responseBody
     *
     * @return TokenInterface
     *
     * @throws TokenResponseException
     */
    protected function parseAccessTokenResponse($responseBody)
    {
        $data = json_decode($responseBody, true);
        if (null === $data || !is_array($data)) {
            throw new TokenResponseException('Unable to parse response.');
        } elseif (isset($data['error'])) {
            throw new TokenResponseException('Error in retrieving token: "' . $data['error'] . '"');
        }
        $token = new StdOAuth2Token();
        $token->setAccessToken($data['access_token']);
        $token->setEndOfLife(StdOAuth2Token::EOL_NEVER_EXPIRES);
        unset($data['access_token']);
        $token->setExtraParams($data);
        return $token;
    }

    /**
     * Returns the authorization API endpoint.
     *
     * @return UriInterface
     */
    public function getAuthorizationEndpoint()
    {
        return new Uri('https://www.wunderlist.com/oauth/authorize');
    }

    /**
     * Returns the access token API endpoint.
     *
     * @return UriInterface
     */
    public function getAccessTokenEndpoint()
    {
        return new Uri('https://www.wunderlist.com/oauth/access_token');
    }

    protected function getExtraApiHeaders()
    {
        $token = $this->storage->retrieveAccessToken($this->service());
        return array(
            'X-Client-ID' => $this->credentials->getConsumerId(),
            'X-Access-Token' => $token->getAccessToken()
        );
    }
}