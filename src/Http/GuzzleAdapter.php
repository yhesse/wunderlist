<?php

namespace Wunderlist\Http;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

/**
 * Abstraction layer for connecting on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class GuzzleAdapter implements HttpClientInterface
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
        return $this->serializer->deserialize($data, $type, 'json');
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
        $content = $this->client->get($resource, $options)->getBody()->getContents();
        return $this->deserialize($content, $type);
    }

    public function post($resource, $body, $type, $options = [])
    {
        $options['body'] = $this->serializer->serialize($body, 'json');
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        $content = $this->client->post($resource, $options)->getBody()->getContents();
        return $this->deserialize($content, $type);
    }

    public function put($resource, $body, $type, $options = [])
    {
        $options['body'] = $this->serializer->serialize($body, 'json');
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        $content = $this->client->put($resource, $options)->getBody()->getContents();
        return $this->deserialize($content, $type);
    }

    public function patch($resource, $data, $type, $options = [])
    {
        $options['json'] = $data;
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        $content = $this->client->patch($resource, $options)->getBody()->getContents();
        return $this->deserialize($content, $type);
    }

    public function delete($resource, $type, $options = [])
    {
        return $this->client->delete($resource, $options)->json();
    }
}
