<?php

namespace Wunderlist\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Entity\Task;
use Wunderlist\Entity\User;
use Wunderlist\Entity\WList;

/**
 * Represents an API service.
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
interface ServiceInterface
{
    /**
     * Gets the service's base path. For example 'tasks' will become 'https://a.wunderlist.com/api/v1/tasks'
     * when an HTTP request is made.
     * @return string
     */
    public function getBaseUrl();

    /**
     * Gets the supported type for the service
     * @return string
     */
    public function getType();

    /**
     * Makes a GET request to the API
     * @param string $resource The path to make the request
     * @param string $type The deserialization class name
     * @param array $options Guzzle options for the request
     * @return mixed
     */
    public function get($resource, $type, array $options = []);

    /**
     * Creates a POST request to the API
     * @param string $resource The path to make the request
     * @param array $data $data to be send
     * @param string $type The deserialization class name
     * @param array $options Guzzle options for the request
     * @return mixed
     */
    public function post($resource, $data, $type, array $options = []);

    /**
     * Creates an entity at the API
     * @param object $entity The Entity to be created
     * @param array $options Guzzle options for the request
     * @return object
     */
    public function create($entity, array $options = []);

    /**
     * Updates an entity at the API
     * @param IdentifiableInterface $entity The Entity to be updated
     * @param array $options Guzzle options for the request
     * @return object
     */
    public function update(IdentifiableInterface $entity, array $options = []);

    /**
     * Updates only certain fields at the API
     * @param int $id The resource id
     * @param array $data The data to be updated
     * @param string $type The deserialization class name
     * @param array $options Guzzle options for the request
     * @return object
     */
    public function patch($id, $data, $type, array $options = []);

    /**
     * Deletes an entity from the API
     * @param IdentifiableInterface $entity The Entity to be deleted
     * @param array $options Guzzle options for the request
     * @return object
     */
    public function delete(IdentifiableInterface $entity, array $options = []);

    /**
     * Gets a entity base on the ID.
     * @param $id The entity's ID
     * @return object
     */
    public function getID($id);

    /**
     * Performs a GET for a user ID on the resource.
     * @param User $user - The user id.
     * @return ArrayCollection
     */
    public function forUser(User $user);

    /**
     * Performs a GET for a task ID on the resource.
     * @param Task $task - The task id.
     * @return ArrayCollection
     */
    public function forTask(Task $task);

    /**
     * Performs a GET for a list ID on the resource.
     * @param WList $list - The list id.
     * @return ArrayCollection
     */
    public function forList(WList $list);
}
