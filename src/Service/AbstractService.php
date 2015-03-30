<?php

namespace Wunderlist\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\User;
use Wunderlist\Entity\WList;
use Wunderlist\Http\HttpClientInterface;

/**
 * Contains the basic implementations for an API service.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * The service's base path. For example 'tasks' will become 'https://a.wunderlist.com/api/v1/tasks'
     * when an HTTP request is made.
     * @var string
     */
    protected $baseUrl;

    /**
     * The service's resource type. For examples 'Task' for services/Tasks
     * @var string
     */
    protected $type;

    /**
     * @var HttpClientInterface
     */
    protected $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function get($resource, $type, array $options = [])
    {
        return $this->client->get($resource, $type, $options);
    }

    public function create($entity, array $options = [])
    {
        return $this->client->post($this->getBaseUrl(), $entity, get_class($entity), $options);
    }

    public function post($resource, $data, $type, array $options = [])
    {
        return $this->client->post($this->getBaseUrl(), $data, $type, $options);
    }

    public function update(IdentifiableInterface $entity, array $options = [])
    {
        return $this->client->put($this->getBaseUrl() . '/' . $entity->getId(), $entity, $options);
    }

    public function patch($id, $data, $type, array $options = [])
    {
        return $this->client->patch($this->getBaseUrl() . '/' . $id, $data, $type, $options);
    }

    public function delete(IdentifiableInterface $entity, array $options = [])
    {
        return $this->client->delete($this->getBaseUrl() . '/' . $entity->getId(), $entity, $options);
    }

    public function getID($id)
    {
        return $this->get($this->getBaseUrl() . '/' . $id, $this->type);
    }

    protected function getItemsForAttribute($url, $attribute, $value, $type)
    {
        $data[$attribute] = $value;
        return $this->get($url, $type, [
            'query' => $data
        ]);
    }

    protected function getItemsForAttributes($url, $data, $type)
    {
        return $this->get($url, $type, [
            'query' => $data
        ]);
    }

    /**
     * Performs a GET for a user ID on the resource.
     * @param User $user - The user id.
     * @return ArrayCollection
     */
    public function forUser(User $user)
    {
        return $this->getItemsForAttribute($this->getBaseUrl(), 'user_id', $user->getId(), "ArrayCollection<{$this->type}>");
    }

    /**
     * Performs a GET for a task ID on the resource.
     * @param Task $task - The task id.
     * @return ArrayCollection
     */
    public function forTask(Task $task)
    {
        return $this->getItemsForAttribute($this->getBaseUrl(), 'task_id', $task->getId(), "ArrayCollection<{$this->type}>");
    }

    /**
     * Performs a GET for a list ID on the resource.
     * @param WList $list - The list id.
     * @return ArrayCollection
     */
    public function forList(WList $list)
    {
        return $this->getItemsForAttribute($this->getBaseUrl(), 'list_id', $list->getId(), "ArrayCollection<{$this->type}>");
    }
}
