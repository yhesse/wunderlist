<?php

namespace Wunderlist\Service;

use League\OAuth2\Client\Grant\RefreshToken;
use League\OAuth2\Client\Provider\ProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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

    public function __construct(ProviderInterface $provider)
    {
        $request = Request::createFromGlobals();
        $session = new Session();
        if (!$session->isStarted()) {
            $session->start();
        }
        $request->setSession($session);
        $this->request = $request;
        $this->provider = $provider;
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
        if (!$this->request->query->has('code')) {
            // If we don't have an authorization code then get one
            $authUrl = $this->provider->getAuthorizationUrl();
            $this->request->getSession()->set('oauth2state', $this->provider->state);
            $response = new RedirectResponse($authUrl);
            $response->send();
        } elseif (empty($this->request->query->get('state')) || ($this->request->query->get('state') !== $this->request->getSession()->get('oauth2state'))) {
            $this->request->getSession()->remove('oauth2state');
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
