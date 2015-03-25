<?php

namespace Wunderlist;


use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\User;
use Wunderlist\Entity\WList;

abstract class ApiClient
{
    /**
     * The service's base path. For example 'tasks' will become 'https://a.wunderlist.com/api/v1/tasks' when an HTTP request is made.
     * @var string
     */
    protected $baseUrl;

    /**
     * The service's resource type. For examples 'Task' for services/Tasks
     * @var string
     */
    protected $type;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    public function __construct(Client $client, $params)
    {
        $this->client = $client;
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()
            ->setCacheDir(__DIR__ . '/../var/cache')
            ->addMetadataDir(__DIR__ . '/Resources/serializer')
            ->build();
    }

    protected function serialize($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    protected function deserialize($data, $type)
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

    protected function get($resource, $options = [])
    {
        return $this->client->get($resource, $options)->getBody()->getContents();
    }

    protected function post($resource, $data, $options = [])
    {
        $options['json'] = $data;
        $result = $this->client->post($resource, $options)->json();
        return $this->deserialize($result, $this->type);
    }

    protected function patch($resource, $id, $data, $options = [])
    {
        $resource .= '/' . $id;
        $options['json'] = $data;
        $result = $this->client->patch($resource, $options)->json();
        return $this->deserialize($result, $this->type);
    }

    public function delete($id, $options = [])
    {
        return $this->client->delete($this->getBaseUrl() . '/' . $id, $options)->json();
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