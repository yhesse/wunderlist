<?php

namespace Wunderlist\Service;

use Collections\ArrayList;
use Wunderlist\Entity\Subtask;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

class SubtaskService extends AbstractService
{
    protected $userService;
    protected $baseUrl = 'subtasks';
    protected $type = Subtask::class;

    public function forList(WList $list, $completed = false)
    {
        $params = [
            'list_id' => $list->getId(),
            'completed' => $completed
        ];

        return $this->getItemsForAttributes($this->getBaseUrl(), $params, "ArrayCollection<{$this->type}>");
    }

    public function forTask(Task $task, $completed = false)
    {
        $params = [
            'task_id' => $task->getId(),
            'completed' => $completed
        ];

        return $this->getItemsForAttributes($this->getBaseUrl(), $params, "ArrayCollection<{$this->type}>");
    }
}
