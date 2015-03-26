<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\SubtaskPosition;

class ListPositionService extends AbstractService
{
    protected $baseUrl = 'list_positions';
    protected $type = SubtaskPosition::class;
}
