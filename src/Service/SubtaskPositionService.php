<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\SubtaskPosition;

class SubtaskPositionService extends AbstractService
{
    protected $baseUrl = 'subtask_positions';
    protected $type = SubtaskPosition::class;
}
