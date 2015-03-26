<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\TaskComment;

class TaskCommentsService extends AbstractService
{
    protected $baseUrl = 'task_comments';
    protected $type = TaskComment::class;
}
