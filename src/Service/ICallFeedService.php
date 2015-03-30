<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\ICallFeed;

class ICallFeedService extends AbstractGetOnlyService
{
    protected $baseUrl = 'ical/feed';
    protected $type = ICallFeed::class;
}
