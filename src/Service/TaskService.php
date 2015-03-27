<?php

namespace Wunderlist\Service;

use Carbon\Carbon;
use Collections\ArrayList;
use React\Promise\Promise;
use Wunderlist\ApiClient;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

class TaskService extends AbstractService
{
    protected $userService;
    protected $listService;
    protected $baseUrl = 'tasks';
    protected $type = Task::class;

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
        $this->userService = new UserService($client);
        $this->subtaskService = new SubtaskService($client);
        $this->listService = new ListService($client);
    }

    public function forList(WList $list, $completed = false)
    {
        $data = [
            'list_id' => $list->getId(),
            'completed' => $completed
        ];

        return $this->getItemsForAttributes($this->getBaseUrl(), $data)->then(function ($content) {
            return new ArrayList($this->deserialize($content, "ArrayCollection<{$this->type}>"));
        });
    }

    public function all(WList $list)
    {
        return $this->forList($list);
    }

    public function allWithSubtasks(WList $list)
    {
        return $this->all($list)->then(function ($tasks) {
            return $tasks->map(function (Task $task) {
                return $this->subtaskService->forTask($task)->then(function ($subtasks) use ($task) {
                    return $task->setSubtasks($subtasks);
                });
            });
        });
    }

    /**
     * @param Carbon $date
     * @return Promise
     */
    public function filterByDate(Carbon $date)
    {
        return $this->listService->all()
            ->then(function ($lists) {
                $allTasks = new ArrayList();
                foreach ($lists as $list) {
                    $this->forList($list)->done(function ($tasks) use ($allTasks) {
                        $allTasks->addAll($tasks);
                    });
                }
                return $allTasks;
            })
            ->then(function ($allTasks) use ($date) {
                return $allTasks->filter(function (Task $task) use ($date) {
                    if ($task->getDueDate()) {
                        $taskDate = Carbon::instance($task->getDueDate());
                        return $taskDate->toDateString() === $date->toDateString();
                    }
                });
            });
    }

    /**
     * @return Promise
     */
    public function today()
    {
        return $this->filterByDate(Carbon::today());
    }

    /**
     * @return Promise
     */
    public function overdue()
    {
        $today = Carbon::today();
        return $this->listService->all()
            ->then(function ($lists) {
                $overdueTasks = new ArrayList();
                foreach ($lists as $list) {
                    $this->forList($list)->done(function ($tasks) use ($overdueTasks) {
                        $overdueTasks->addAll($tasks);
                    });
                }
                return $overdueTasks;
            })
            ->then(function ($overdueTasks) use ($today) {
                return $overdueTasks->filter(function (Task $task) use ($today) {
                    if ($task->getDueDate()) {
                        $date = Carbon::instance($task->getDueDate());
                        return $date->gt($today);
                    }
                });
            });
    }
}
