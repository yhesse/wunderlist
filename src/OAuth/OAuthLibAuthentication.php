<?php

namespace Wunderlist\OAuth;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Wunderlist\OAuth\Service\Wunderlist;

/**
 * Responsible for authenticating on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class OAuthLibAuthentication implements AuthenticationInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Wunderlist
     */
    protected $wunderlistService;

    public function __construct(Wunderlist $wunderlistService, Request $request)
    {
        $this->request = $request;
        $this->wunderlistService = $wunderlistService;
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
    public function getConsumerId()
    {
        return $this->wunderlistService->getConsumerId();
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->wunderlistService->getStorage()->retrieveAccessToken($this->wunderlistService->service());
    }

    /**
     * @return string
     */
    public function hasAccessToken()
    {
        return $this->wunderlistService->getStorage()->hasAccessToken($this->wunderlistService->service());
    }

    public function authorize()
    {
        if ($this->request->has('code')) {
            $state = $this->request->get('state');
            // This was a callback request from linkedin, get the token
            return $this->wunderlistService->requestAccessToken($this->request->get('code'), $state);
        } else {
            $url = $this->wunderlistService->getAuthorizationUri();
            $response = new RedirectResponse($url);
            $response->send();
        }
    }
}
