<?php

namespace Wunderlist\OAuth;

use Symfony\Component\HttpFoundation\Request;

/**
 * Responsible for authenticating on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
interface AuthenticationInterface
{
    /**
     * @return Request
     */
    public function getRequest();

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest($request);

    /**
     * @return string
     */
    public function getConsumerId();

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @return string
     */
    public function hasAccessToken();

    public function authorize();
}
