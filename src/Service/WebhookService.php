<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\Webhook;

class WebhookService extends AbstractService
{
    protected $baseUrl = 'webhooks';
    protected $type = Webhook::class;
}
