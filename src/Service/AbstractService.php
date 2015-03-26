<?php

namespace Wunderlist\Service;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\SerializerBuilder;
use Wunderlist\ApiClient;
use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\User;
use Wunderlist\Entity\WList;

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
     * @var ApiClient
     */
    protected $client;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
        $this->serializer = SerializerBuilder::create()
            ->setCacheDir(__DIR__ . '/../../var/cache')
            ->addMetadataDir(__DIR__ . '/../Resources/serializer')
            ->build();
    }

    public function serialize($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize($data, $type)
    {
        return $this->serializer->deserialize($data, $type, 'json');
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function get($resource, $options = [])
    {
        return $this->client->get($resource, $options);
    }

    public function create($entity, $options = [])
    {
        $jsonContent = $this->serializer->serialize($entity, 'json');
        $result = $this->client->post($this->getBaseUrl(), $jsonContent, $options);
        return $this->deserialize($result, $this->type);
    }

    public function update(IdentifiableInterface $entity, $options = [])
    {
        $jsonContent = $this->serializer->serialize($entity, 'json');
        $result = $this->client->put($this->getBaseUrl(), $entity->getId(), $jsonContent, $options);
        return $this->deserialize($result, $this->type);
    }

    public function patch($id, $data, $options = [])
    {
        $result = $this->client->patch($this->getBaseUrl(), $id, $data, $options);
        return $this->deserialize($result, $this->type);
    }

    public function delete(IdentifiableInterface $entity, $options = [])
    {
        return $this->client->delete($this->getBaseUrl(), $entity, $options);
    }

    public function getID($id)
    {
        $data = $this->get($this->getBaseUrl() . '/' . $id);
        return $this->deserialize($data, $this->type);
    }

    protected function getItemsForAttribute($url, $attribute, $value)
    {
        $data[$attribute] = $value;
        return $this->get($url, [
            'query' => $data
        ]);
    }

    protected function getItemsForAttributes($url, $data)
    {
        return $this->get($url, [
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
        $data = $this->getItemsForAttribute($this->getBaseUrl(), 'user_id', $user->getId());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    /**
     * Performs a GET for a task ID on the resource.
     * @param Task $task - The task id.
     * @return ArrayCollection
     */
    public function forTask(Task $task)
    {
        $data = $this->getItemsForAttribute($this->getBaseUrl(), 'task_id', $task->getId());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    /**
     * Performs a GET for a list ID on the resource.
     * @param WList $list - The list id.
     * @return ArrayCollection
     */
    public function forList(WList $list)
    {
        $data = $this->getItemsForAttribute($this->getBaseUrl(), 'list_id', $list->getId());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }
}