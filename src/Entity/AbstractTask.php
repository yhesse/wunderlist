<?php

namespace Wunderlist\Entity;

abstract class AbstractTask implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var integer
     */
    protected $taskID;

    /**
     * @var integer
     */
    protected $createdByID;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var \DateTime
     */
    protected $completedAt;

    /**
     * @var integer
     */
    protected $completedByID;

    /**
     * @var boolean
     */
    protected $completed;

    /**
     * @return integer
     */
    public function getTaskID()
    {
        return $this->taskID;
    }

    /**
     * @param integer $taskID
     * @return $this
     */
    public function setTaskID($taskID)
    {
        $this->taskID = $taskID;
        return $this;
    }

    /**
     * @return integer
     */
    public function getCreatedByID()
    {
        return $this->createdByID;
    }

    /**
     * @param integer $createdByID
     * @return $this
     */
    public function setCreatedByID($createdByID)
    {
        $this->createdByID = $createdByID;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param \DateTime $completedAt
     * @return $this
     */
    public function setCompletedAt(\DateTime $completedAt)
    {
        $this->completedAt = $completedAt;
        return $this;
    }

    /**
     * @return integer
     */
    public function getCompletedByID()
    {
        return $this->completedByID;
    }

    /**
     * @param integer $completedByID
     * @return $this
     */
    public function setCompletedByID($completedByID)
    {
        $this->completedByID = $completedByID;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * @param boolean $completed
     * @return $this
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
        return $this;
    }
}
