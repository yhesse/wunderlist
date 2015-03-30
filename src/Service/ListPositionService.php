<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\ListPosition;

class ListPositionService extends AbstractService
{
    protected $baseUrl = 'list_positions';
    protected $type = ListPosition::class;
}
