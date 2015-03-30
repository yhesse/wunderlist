<?php

namespace Wunderlist;

use Collections\Dictionary;
use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\User;
use Wunderlist\Entity\WList;
use Wunderlist\Http\HttpClientInterface;
use Wunderlist\OAuth\AuthenticationInterface;
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
     * @var AuthenticationInterface
     */
    protected $authenticationService;

    /**
     * @var HttpClientInterface
     */
    protected $client;

    public function __construct(AuthenticationInterface $authenticationService, HttpClientInterface $client)
    {
        $this->authenticationService = $authenticationService;
        $this->services = new Dictionary();
        $this->client = $client;
        $this->registerDefaultServices($this->client);
    }

    /**
     * @param $service
     * @return ServiceInterface
     */
    public function getService($service)
    {
        //Lazy authentication
        $token = $this->authenticationService->getAccessToken();
        if (!$token->getAccessToken()) {
            $this->authenticationService->authorize();
        }

        $this->client->createClient($this->authenticationService->getConsumerId(), $token->getAccessToken());
        return $this->services->get($service);
    }

    public function find($entity, $id)
    {
        return $this->getService($entity)->getID($id);
    }

    public function forUser($entity, User $user)
    {
        return $this->getService($entity)->forUser($user);
    }

    public function forTask($entity, Task $task)
    {
        return $this->getService($entity)->forTask($task);
    }

    public function forList($entity, WList $list)
    {
        return $this->getService($entity)->forList($list);
    }

    /**
     * @param IdentifiableInterface $entity The entity to be saved
     * @return ServiceInterface
     */
    public function save(IdentifiableInterface $entity)
    {
        $service = $this->getService(get_class($entity));
        if ($entity->getId()) {
            return $service->update($entity);
        }
        return $service->create($entity);
    }

    public function delete(IdentifiableInterface $entity)
    {
        return $this->getService(get_class($entity))->delete($entity);
    }

    protected function registerDefaultServices(HttpClientInterface $client)
    {
        $this->registerService(new ListService($client))
            ->registerService(new MembershipService($client))
            ->registerService(new TaskService($client))
            ->registerService(new SubtaskService($client))
            ->registerService(new SubtaskPositionService($client))
            ->registerService(new TaskPositionService($client))
            ->registerService(new ListPositionService($client))
            ->registerService(new NoteService($client))
            ->registerService(new ReminderService($client))
            ->registerService(new TaskCommentsService($client))
            ->registerService(new WebhookService($client))
            ->registerService(new AvatarService($client))
            ->registerService(new UserService($client))
            ->registerService(new TaskCountService($client));
    }

    /**
     * Register a service
     * @param ServiceInterface $service The service object
     * @return $this
     * @throws \Collections\Exception\KeyException
     */
    public function registerService(ServiceInterface $service)
    {
        $this->services->add($service->getType(), $service);
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
}
