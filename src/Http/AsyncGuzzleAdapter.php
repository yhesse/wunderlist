<?php

namespace Wunderlist\Http;

use Collections\ArrayList;
use Guzzle\Http\Message\Response;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

/**
 * Abstraction layer for connecting on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class AsyncGuzzleAdapter implements HttpClientInterface
{
    protected static $apiUrl = 'https://a.wunderlist.com/api/{version}/';
    protected static $version = 'v1';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize($data, $type)
    {
        $result = $this->serializer->deserialize($data, $type, 'json');
        if (preg_match('/ArrayCollection/', $type)) {
            $result = new ArrayList($result);
        }
        return $result;
    }

    public function createClient($clientID, $accessToken)
    {
        $this->client = new Client([
            'base_url' => [static::$apiUrl, ['version' => static::$version]],
            'defaults' => [
                'headers' => [
                    'X-Access-Token' => $accessToken,
                    'X-Client-ID' => $clientID
                ]
            ]]);
    }

    public function get($resource, $type, $options = [])
    {
        $options['future'] = true;
        return $this->client->get($resource, $options)->then(function (Response $reponse) {
            return $reponse->getBody()->getContents();
        })->then(function ($content) use ($type) {
            return $this->deserialize($content, $type);
        });

    }

    public function post($resource, $body, $type, $options = [])
    {
        $options['future'] = true;
        $options['body'] = $this->serializer->serialize($body, 'json');
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->post($resource, $options)->then(function (Response $reponse) {
            return $reponse->getBody()->getContents();
        })->then(function ($content) use ($type) {
            return $this->deserialize($content, $type);
        });
    }

    public function put($resource, $body, $type, $options = [])
    {
        $options['future'] = true;
        $options['body'] = $this->serializer->serialize($body, 'json');
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->put($resource, $options)->then(function (Response $reponse) {
            return $reponse->getBody()->getContents();
        })->then(function ($content) use ($type) {
            return $this->deserialize($content, $type);
        });
    }

    public function patch($resource, $data, $type, $options = [])
    {
        $options['future'] = true;
        $options['json'] = $data;
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->patch($resource, $options)->then(function (Response $reponse) {
            return $reponse->getBody()->getContents();
        })->then(function ($content) use ($type) {
            return $this->deserialize($content, $type);
        });
    }

    public function delete($resource, $type, $options = [])
    {
        $options['future'] = true;
        return $this->client->delete($resource, $options)->then(function (Response $reponse) {
            return $reponse->json();
        });
    }
}
