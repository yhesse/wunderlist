<?php

namespace Wunderlist\Service;

use Carbon\Carbon;
use Collections\ArrayList;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;
use Wunderlist\Http\HttpClientInterface;

class TaskService extends AbstractService
{
    protected $userService;
    protected $listService;
    protected $baseUrl = 'tasks';
    protected $type = Task::class;

    public function __construct(HttpClientInterface $client)
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

        return $this->getItemsForAttributes($this->getBaseUrl(), $data, "ArrayCollection<{$this->type}>");
    }

    public function all(WList $list)
    {
        return $this->forList($list);
    }

    public function allWithSubtasks(WList $list)
    {
        $tasks = new ArrayList($this->all($list));
        $tasksWithSubtaks = $tasks->map(function (Task $task) {
            return $task->setSubtasks($this->subtaskService->forTask($task));
        });

        return $tasksWithSubtaks;
    }

    public function filterByDate(Carbon $date)
    {
        $lists = $this->listService->all();
        $todayTasks = new ArrayList();

        foreach ($lists as $list) {
            $tasks = new ArrayList($this->forList($list));
            $listTasks = $tasks->filter(function (Task $task) use ($date) {
                if ($task->getDueDate()) {
                    $taskDate = Carbon::instance($task->getDueDate());
                    return $taskDate->toDateString() === $date->toDateString();
                }
            });
            $todayTasks->concat($listTasks);
        }

        return $todayTasks;
    }

    public function today()
    {
        return $this->filterByDate(Carbon::today());
    }

    public function overdue()
    {
        $lists = $this->listService->all();
        $overdueTasks = new ArrayList();
        $today = Carbon::today();

        foreach ($lists as $list) {
            $tasks = new ArrayList($this->forList($list));
            $listTasks = $tasks->filter(function (Task $task) use ($today) {
                if ($task->getDueDate()) {
                    $date = Carbon::instance($task->getDueDate());
                    return $date->gt($today);
                }
            });
            $overdueTasks->concat($listTasks);
        }

        return $overdueTasks;
    }
}
