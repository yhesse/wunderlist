<?php

namespace Wunderlist;

use GuzzleHttp\Client;

class Wunderlist
{
    protected $listService;
    protected $membershipService;
    protected $taskService;
    protected $subtaskService;

    protected $apiUrl = 'https://a.wunderlist.com/api/{version}/';
    protected $version = 'v1';

    public function __construct($params)
    {
        $authenticator = new ApiAuthenticator($this->createProvider($params));
        $accessToken = $authenticator->authorize();
        $client = $this->createGuzzle($params['clientId'], $accessToken);

        $this->listService = new ListService($client, $params);
        $this->membershipService = new MembershipService($client, $params);
        $this->taskService = new TaskService($client, $params);
        $this->subtaskService = new SubtaskService($client, $params);
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
        return $this->listService;
    }

    public function getTasks()
    {
        return $this->taskService;
    }

    public function getMemberships()
    {
        return $this->membershipService;
    }

    /**
     * @return SubtaskService
     */
    public function getSubtasks()
    {
        return $this->subtaskService;
    }

    public function getToday()
    {
//        $lists = $this->getLists()->getAll();
//        $todayTasks = new Dictionary();
//        foreach ($lists as $list) {
//            $tasks = $this->getTasks()->getAll($list->get('id'));
//
//            $listTasks = $tasks->filter(function ($task) {
//                if ($task->tryGet('due_date')) {
//                    $date = new Carbon($task->get('due_date'));
//                    return $date->isToday() ? $task : null;
//                }
//                return null;
//            });
//dump($listTasks);
//            $todayTasks->concat($listTasks);
//        }
//
//        return new Dictionary($todayTasks);
    }
}
