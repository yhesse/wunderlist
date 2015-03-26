<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\TaskPosition;

class SubtaskPositionService extends AbstractService
{
    protected $baseUrl = 'subtask_positions';
    protected $type = TaskPosition::class;
}
