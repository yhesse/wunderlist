<?php

namespace Wunderlist\Entity;

class Task
{
    protected $id;
    protected $assigneeID;
    protected $createdAt;
    protected $createdByID;
    protected $dueDate;
    protected $listID;
    protected $revision;
    protected $starred;
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
    public function getAssigneeID()
    {
        return $this->assigneeID;
    }

    /**
     * @param mixed $assigneeID
     */
    public function setAssigneeID($assigneeID)
    {
        $this->assigneeID = $assigneeID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param mixed $listID
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
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
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param mixed $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStarred()
    {
        return $this->starred;
    }

    /**
     * @param mixed $starred
     */
    public function setStarred($starred)
    {
        $this->starred = $starred;
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
    public function isCompleted()
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
