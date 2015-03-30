<?php

namespace Wunderlist;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use Symfony\Component\HttpFoundation\Request;
use Wunderlist\Http\GuzzleAdapter;
use Wunderlist\Http\HttpClientFactory;
use Wunderlist\Http\HttpClientInterface;
use Wunderlist\OAuth\AuthenticationInterface;
use Wunderlist\OAuth\OAuthLibAuthentication;

/**
 * Represents the wunderlist API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class ClientBuilder
{
    /**
     * @var AuthenticationInterface
     */
    protected $authenticator;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function build($clientID = null, $clientSecret = null, $callbackUrl = null)
    {
        if (!$this->authenticator) {
            if (!$clientID || !$clientSecret || !$callbackUrl) {
                throw new \InvalidArgumentException('You didn\'t set an authenticator, so you must provide a clientID, clientSecret and callbackURL');
            }

            $this->authenticator = $this->buildDefaultAuthenticator($clientID, $clientSecret, $callbackUrl);
        }

        if (!$this->serializer) {
            $this->serializer = $this->buildDefaultSerializer();
        }

        $factory = new HttpClientFactory();
        $httpClientName = $this->httpClient ?: GuzzleAdapter::class;
        $this->httpClient = $factory->build($httpClientName, $this->serializer);
        
        return new Wunderlist($this->authenticator, $this->httpClient);
    }

    protected function buildDefaultAuthenticator($clientID, $clientSecret, $callbackUrl)
    {
        $credentials = new Credentials($clientID, $clientSecret, $callbackUrl);
        $facotry = new ServiceFactory();
        $session = new Session();
        $service = $facotry->createService('wunderlist', $credentials, $session);
        $request = Request::createFromGlobals();
        return new OAuthLibAuthentication($service, $request);

    }

    protected function buildDefaultHttpClient($serializer)
    {
        $factory = new HttpClientFactory();
        return $factory->build(GuzzleAdapter::class, $serializer);
    }

    private function buildDefaultSerializer()
    {
        return SerializerBuilder::create()->build();
    }

    /**
     * @return AuthenticationInterface
     */
    public function getAuthenticator()
    {
        return $this->authenticator;
    }

    /**
     * @param $authenticator
     * @return $this
     */
    public function setAuthenticator($authenticator)
    {
        $this->authenticator = $authenticator;
        return $this;
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return $this
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     * @return $this
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }
}
