<?php

namespace Wunderlist\Http;

use JMS\Serializer\Serializer;

/**
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class HttpClientFactory
{
    public function build($clientName, Serializer $serializer)
    {
        $reflection = new \ReflectionClass($clientName);
        return $reflection->newInstanceArgs([$serializer]);
    }
}
