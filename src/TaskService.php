<?php

namespace Wunderlist;

use GuzzleHttp\Client;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

class TaskService extends ApiClient
{
    protected $userService;
    protected $baseUrl = 'tasks';
    protected $type = Task::class;

    public function __construct(Client $client, $params)
    {
        parent::__construct($client, $params);
        $this->userService = new UserService($client, $params);
    }

    public function all(WList $list)
    {
        $data = $this->forList($list);;
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function completed(WList $list)
    {
        $tasks = $this->forList($list);
        $data = $tasks->filter(function (Task $task) {
            return $task->isCompleted() === true;
        });

        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function uncompleted(WList $list)
    {
        $tasks = $this->forList($list);
        $data = $tasks->filter(function (Task $task) {
            return $task->isCompleted() === false;
        });

        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    /**
     * Create a task.
     * @param Task $data Task creation data.
     * @return mixed
     */
    public function create(Task $data)
    {
        return $this->post($this->getBaseUrl(), $data);
    }

    public function update(Task $data)
    {
        return $this->patch('lists', $data->getId(), $data);
    }
}
