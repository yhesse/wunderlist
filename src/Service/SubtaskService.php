<?php

namespace Wunderlist\Service;

use Collections\ArrayList;
use React\Promise\Promise;
use Wunderlist\Entity\Subtask;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

class SubtaskService extends AbstractService
{
    protected $userService;
    protected $baseUrl = 'subtasks';
    protected $type = Subtask::class;

    /**
     * @param WList $list
     * @param bool $completed
     * @return Promise
     */
    public function forList(WList $list, $completed = false)
    {
        $params = [
            'list_id' => $list->getId(),
            'completed' => $completed
        ];

        return $this->getItemsForAttributes($this->getBaseUrl(), $params)->then(function ($content) {
            return new ArrayList($this->deserialize($content, "ArrayCollection<{$this->type}>"));
        });
    }

    /**
     * @param Task $task
     * @param bool $completed
     * @return Promise
     */
    public function forTask(Task $task, $completed = false)
    {
        $params = [
            'task_id' => $task->getId(),
            'completed' => $completed
        ];

        return $this->getItemsForAttributes($this->getBaseUrl(), $params)->then(function ($content) {
            return new ArrayList($this->deserialize($content, "ArrayCollection<{$this->type}>"));
        });

    }
}
