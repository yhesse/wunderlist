<?php

namespace Wunderlist;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

class TaskService extends AbstractService
{
    protected $userService;
    protected $baseUrl = 'tasks';
    protected $type = Task::class;

    public function __construct(Client $client, $params)
    {
        parent::__construct($client, $params);
        $this->userService = new UserService($client, $params);
        $this->subtaskService = new SubtaskService($client, $params);
    }

    public function forList(WList $list, $completed = false)
    {
        $data = [
            'list_id' => $list->getId(),
            'completed' => $completed
        ];

        $data = $this->getItemsForAttributes($this->getBaseUrl(), $data);
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function all(WList $list)
    {
        return $this->forList($list);
    }

    public function allWithSubtasks(WList $list)
    {
        $tasks = new ArrayCollection($this->all($list));
        $tasksWithSubtaks = $tasks->map(function (Task $task) {
            return $task->setSubtasks($this->subtaskService->forTask($task));
        });

        return $tasksWithSubtaks;
    }
}
