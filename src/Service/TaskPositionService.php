<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\TaskPosition;

class TaskPositionService extends AbstractService
{
    protected $baseUrl = 'task_positions';
    protected $type = TaskPosition::class;
}
