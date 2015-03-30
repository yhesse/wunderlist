<?php

namespace Wunderlist\Http;

/**
 * Abstraction layer for connecting on the API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
interface HttpClientInterface
{
    public function createClient($clientID, $accessToken);

    public function get($resource, $type, $options = []);

    public function post($resource, $body, $type, $options = []);

    public function put($resource, $body, $type, $options = []);

    public function patch($resource, $data, $type, $options = []);

    public function delete($resource, $type, $options = []);
}
