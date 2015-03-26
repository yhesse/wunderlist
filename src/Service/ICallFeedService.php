<?php

namespace Wunderlist\Service;

class ICallFeedService extends AbstractGetOnlyService
{
    protected $baseUrl = 'ical/feed';
    protected $type = 'stdClass';
}
