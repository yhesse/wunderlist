<?php

namespace Wunderlist;

use GuzzleHttp\Client;
use React\Promise\Promise;
use Wunderlist\Entity\IdentifiableInterface;

/**
 * Abstraction layer for connecting on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class ApiClient
{
    protected $apiUrl = 'https://a.wunderlist.com/api/{version}/';
    protected $version = 'v1';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function createGuzzle($clientID, $accessToken)
    {
        $this->client = new Client([
            'base_url' => [$this->apiUrl, ['version' => $this->version]],
            'defaults' => [
                'headers' => [
                    'X-Access-Token' => $accessToken,
                    'X-Client-ID' => $clientID
                ]
            ]]);
    }

    /**
     * @param $resource
     * @param array $options
     * @return Promise
     */
    public function get($resource, $options = [])
    {
        $options['future'] = true;
        return $this->client->get($resource, $options)->then(function ($response) {
            return $response->getBody()->getContents();
        });
    }

    public function post($resource, $body, $options = [])
    {
        $options['future'] = true;
        $options['body'] = $body;
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->post($resource, $options)->then(function ($response) {
            return $response->getBody()->getContents();
        });
    }

    public function put($resource, $id, $body, $options = [])
    {
        $options['future'] = true;
        $options['body'] = $body;
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->put($resource . '/' . $id, $options)->then(function ($response) {
            return $response->getBody()->getContents();
        });
    }

    public function patch($resource, $id, $data, $options = [])
    {
        $options['future'] = true;
        $options['json'] = $data;
        $options['headers'] = [
            'Content-Type' => 'application/json'
        ];
        return $this->client->patch($resource . '/' . $id, $options)->then(function ($response) {
            return $response->getBody()->getContents();
        });
    }

    public function delete($resource, IdentifiableInterface $entity, $options = [])
    {
        $options['future'] = true;
        $options['query'] = [
            'revision' => $entity->getRevision()
        ];
        return $this->client->delete($resource . '/' . $entity->getId(), $options)->then(function ($response) {
            return $response->json();
        });
    }
}
