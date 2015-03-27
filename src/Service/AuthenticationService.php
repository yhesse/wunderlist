<?php

namespace Wunderlist\Service;

use League\OAuth2\Client\Grant\RefreshToken;
use League\OAuth2\Client\Provider\ProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Responsible for authenticating on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class AuthenticationService
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @var string
     */
    protected $token;

    public function __construct(ProviderInterface $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->token->accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->token->refreshToken;
    }

    /**
     * @return string
     */
    public function getExpires()
    {
        return $this->token->expires;
    }

    public function authorize()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if (!$request->query->has('code')) {
            // If we don't have an authorization code then get one
            $authUrl = $this->provider->getAuthorizationUrl();
            $session->set('oauth2state', $this->provider->state);
            $response = new RedirectResponse($authUrl);
            $response->send();
        } elseif (empty($request->query->get('state')) || ($request->query->get('state') !== $session->get('oauth2state'))) {
            $session->remove('oauth2state');
            throw new \InvalidArgumentException('Invalid State');
        } else {
            // Try to get an access token (using the authorization code grant)
            $this->token = $this->provider->getAccessToken('authorization_code', [
                'code' => $this->request->query->get('code')
            ]);
        }

        return $this->token->accessToken;
    }

    public function refresh($refreshToken)
    {
        $grant = new RefreshToken();
        $this->token = $this->provider->getAccessToken($grant, [
            'refresh_token' => $refreshToken
        ]);
    }
}
