<?php

namespace Wunderlist;

use Carbon\Carbon;
use Collections\ArrayList;
use Collections\Dictionary;
use GuzzleHttp\Client;
use Wunderlist\Entity\Task;
use Wunderlist\Service\AvatarService;
use Wunderlist\Service\ListPositionService;
use Wunderlist\Service\ListService;
use Wunderlist\Service\MembershipService;
use Wunderlist\Service\NoteService;
use Wunderlist\Service\ReminderService;
use Wunderlist\Service\ServiceInterface;
use Wunderlist\Service\SubtaskPositionService;
use Wunderlist\Service\SubtaskService;
use Wunderlist\Service\TaskCommentsService;
use Wunderlist\Service\TaskPositionService;
use Wunderlist\Service\TaskService;
use Wunderlist\Service\UserService;
use Wunderlist\Service\WebhookService;

class Wunderlist
{
    protected $apiUrl = 'https://a.wunderlist.com/api/{version}/';
    protected $version = 'v1';

    protected $services;

    public function __construct($params)
    {
        $authenticator = new ApiAuthenticator($this->createProvider($params));
        $accessToken = $authenticator->authorize();
        $client = $this->createGuzzle($params['clientId'], $accessToken);
        $this->services = new Dictionary();
        $this->registerDefaultServices($client, $params);
    }

    protected function registerDefaultServices($client, $params)
    {
        $this->registerService('lists', new ListService($client, $params))
            ->registerService('memberships', new MembershipService($client, $params))
            ->registerService('tasks', new TaskService($client, $params))
            ->registerService('subtasks', new SubtaskService($client, $params))
            ->registerService('subtaskPositions', new SubtaskPositionService($client, $params))
            ->registerService('taskPositions', new TaskPositionService($client, $params))
            ->registerService('listPositions', new ListPositionService($client, $params))
            ->registerService('notes', new NoteService($client, $params))
            ->registerService('reminders', new ReminderService($client, $params))
            ->registerService('taskComments', new TaskCommentsService($client, $params))
            ->registerService('webhooks', new WebhookService($client, $params))
            ->registerService('avatars', new AvatarService($client, $params))
            ->registerService('users', new UserService($client, $params));
    }

    public function registerService($name, ServiceInterface $service)
    {
        $this->services->add($name, $service);
        return $this;
    }

    protected function createGuzzle($clientID, $accessToken)
    {
        return new Client([
            'base_url' => [$this->apiUrl, ['version' => $this->version]],
            'defaults' => [
                'headers' => [
                    'X-Access-Token' => $accessToken,
                    'X-Client-ID' => $clientID
                ]
            ]]);
    }

    protected function createProvider($params)
    {
        return new \Wunderlist\Provider\Wunderlist($params);
    }

    public function getLists()
    {
        return $this->services->get('lists');
    }

    public function getTasks()
    {
        return $this->services->get('tasks');
    }

    public function getMemberships()
    {
        return $this->services->get('memberships');
    }

    /**
     * @return SubtaskService
     */
    public function getSubtasks()
    {
        return $this->services->get('subtasks');
    }

    /**
     * @return ListPositionService
     */
    public function getListPosition()
    {
        return $this->services->get('listPositions');
    }

    /**
     * @return SubtaskPositionService
     */
    public function getSubtaskPosition()
    {
        return $this->services->get('subtaskPositions');
    }

    /**
     * @return TaskPositionService
     */
    public function getTaskPosition()
    {
        return $this->services->get('taskPositions');
    }

    /**
     * @return AvatarService
     */
    public function getAvatar()
    {
        return $this->services->get('avatars');
    }

    /**
     * @return NoteService
     */
    public function getNotes()
    {
        return $this->services->get('notes');
    }

    /**
     * @return ReminderService
     */
    public function getReminders()
    {
        return $this->services->get('reminders');
    }

    /**
     * @return WebhookService
     */
    public function getWebhooks()
    {
        return $this->services->get('webhooks');
    }

    /**
     * @return UserService
     */
    public function getUser()
    {
        return $this->services->get('users');
    }

    public function filterByDate(Carbon $date)
    {
        $lists = $this->getLists()->all();
        $todayTasks = new ArrayList();

        foreach ($lists as $list) {
            $tasks = new ArrayList($this->getTasks()->forList($list));
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

    public function getTodayTasks()
    {
        return $this->filterByDate(Carbon::today());
    }

    public function getOverdueTasks()
    {
        $lists = $this->getLists()->all();
        $overdueTasks = new ArrayList();
        $today = Carbon::today();

        foreach ($lists as $list) {
            $tasks = new ArrayList($this->getTasks()->forList($list));
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
