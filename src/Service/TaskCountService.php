<?php

namespace Wunderlist\Service;

class TaskCountService extends AbstractService
{
    protected $baseUrl = 'lists/tasks_count';
    protected $type = '\stdClass';
}
