<?php

namespace Wunderlist\Entity;

class Subtask
{
    protected $id;
    protected $taskID;
    protected $createdAt;
    protected $createdByID;
    protected $title;
    protected $completedAt;
    protected $completedByID;
    protected $completed;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaskID()
    {
        return $this->taskID;
    }

    /**
     * @param mixed $taskID
     */
    public function setTaskID($taskID)
    {
        $this->taskID = $taskID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedByID()
    {
        return $this->createdByID;
    }

    /**
     * @param mixed $createdByID
     */
    public function setCreatedByID($createdByID)
    {
        $this->createdByID = $createdByID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param mixed $completedAt
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompletedByID()
    {
        return $this->completedByID;
    }

    /**
     * @param mixed $completedByID
     */
    public function setCompletedByID($completedByID)
    {
        $this->completedByID = $completedByID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
        return $this;
    }
}
