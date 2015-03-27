<?php

namespace Wunderlist;

use Collections\Dictionary;
use Wunderlist\Service\AuthenticationService;
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
use Wunderlist\Service\TaskCountService;
use Wunderlist\Service\TaskPositionService;
use Wunderlist\Service\TaskService;
use Wunderlist\Service\UserService;
use Wunderlist\Service\WebhookService;

/**
 * Represents the wunderlist API.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class Wunderlist
{
    /**
     * @var Dictionary
     */
    protected $services;

    /**
     * @var AuthenticationService
     */
    protected $authenticationService;

    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $clientId;
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
        $this->clientId = $params['clientId'];
        $this->services = new Dictionary();
        $this->client = new ApiClient();
        $this->registerDefaultServices($this->client);
    }

    protected function createProvider($params)
    {
        return new \Wunderlist\Provider\Wunderlist($params);
    }

    protected function registerDefaultServices(ApiClient $client)
    {
        $this->registerService('lists', new ListService($client))
            ->registerService('memberships', new MembershipService($client))
            ->registerService('tasks', new TaskService($client))
            ->registerService('subtasks', new SubtaskService($client))
            ->registerService('subtaskPositions', new SubtaskPositionService($client))
            ->registerService('taskPositions', new TaskPositionService($client))
            ->registerService('listPositions', new ListPositionService($client))
            ->registerService('notes', new NoteService($client))
            ->registerService('reminders', new ReminderService($client))
            ->registerService('taskComments', new TaskCommentsService($client))
            ->registerService('webhooks', new WebhookService($client))
            ->registerService('avatars', new AvatarService($client))
            ->registerService('users', new UserService($client))
            ->registerService('tasksCounts', new TaskCountService($client));
    }

    /**
     * Register a service
     * @param string $name The service name
     * @param ServiceInterface $service The service object
     * @return $this
     * @throws \Collections\Exception\KeyException
     */
    public function registerService($name, ServiceInterface $service)
    {
        $this->services->add($name, $service);
        return $this;
    }

    /**
     * Unregister a service
     * @param string $name The service name
     * @return $this
     */
    public function unregisterService($name)
    {
        $this->services->remove($name);
        return $this;
    }

    /**
     * Gets a service by it's name
     * @param string $service The service name
     * @return ServiceInterface
     */
    public function get($service)
    {
        //Lazy authentication
        $accessToken = $this->authenticationService->authorize();
        $this->client->createGuzzle($this->clientId, $accessToken);

        return $this->services->get($service);
    }

    /**
     * @return AuthenticationService
     */
    public function getAuthentication()
    {
        if (!$this->authenticationService) {
            $request = Request::createFromGlobals();
            $session = new Session();
            if (!$session->isStarted()) {
                $session->start();
            }
            $request->setSession($session);
            $provider = $this->createProvider($this->params);
            $this->authenticationService = new AuthenticationService($provider, $request);
        }
        return $this->authenticationService;
    }

    /**
     * @param AuthenticationService $authenticationService
     * @return $this
     */
    public function setAuthenticationService($authenticationService)
    {
        $this->authenticationService = $authenticationService;
        return $this;
    }

    /**
     * @return ListService
     */
    public function getLists()
    {
        return $this->get('lists');
    }

    /**
     * @return TaskService
     */
    public function getTasks()
    {
        return $this->get('tasks');
    }

    /**
     * @return TaskCountService
     */
    public function getTaskCounts()
    {
        return $this->get('tasksCounts');
    }

    /**
     * @return MembershipService
     */
    public function getMemberships()
    {
        return $this->get('memberships');
    }

    /**
     * @return SubtaskService
     */
    public function getSubtasks()
    {
        return $this->get('subtasks');
    }

    /**
     * @return ListPositionService
     */
    public function getListPosition()
    {
        return $this->get('listPositions');
    }

    /**
     * @return SubtaskPositionService
     */
    public function getSubtaskPosition()
    {
        return $this->get('subtaskPositions');
    }

    /**
     * @return TaskPositionService
     */
    public function getTaskPosition()
    {
        return $this->get('taskPositions');
    }

    /**
     * @return AvatarService
     */
    public function getAvatar()
    {
        return $this->get('avatars');
    }

    /**
     * @return NoteService
     */
    public function getNotes()
    {
        return $this->get('notes');
    }

    /**
     * @return ReminderService
     */
    public function getReminders()
    {
        return $this->get('reminders');
    }

    /**
     * @return WebhookService
     */
    public function getWebhooks()
    {
        return $this->get('webhooks');
    }

    /**
     * @return UserService
     */
    public function getUser()
    {
        return $this->get('users');
    }
}
