<?php

namespace Wunderlist;

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

        $data = $this->getItemsForAttributes($this->getBaseUrl(), $params);
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function forTask(Task $task, $completed = false)
    {
        $params = [
            'task_id' => $task->getId(),
            'completed' => $completed
        ];

        $data = $this->getItemsForAttributes($this->getBaseUrl(), $params);
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }
}
