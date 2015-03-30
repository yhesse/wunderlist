<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

abstract class AbstractTask implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var integer
     * @Type("integer")
     */
    protected $taskId;

    /**
     * @var integer
     * @Type("integer")
     */
    protected $createdById;

    /**
     * @var string
     * @Type("string")
     */
    protected $title;

    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s.uO'>")
     */
    protected $completedAt;

    /**
     * @var integer
     * @Type("integer")
     */
    protected $completedById;

    /**
     * @var boolean
     * @Type("boolean")
     */
    protected $completed;

    /**
     * @return integer
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param integer $taskId
     * @return $this
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * @param integer $createdById
     * @return $this
     */
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;
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
    public function getCompletedById()
    {
        return $this->completedById;
    }

    /**
     * @param integer $completedById
     * @return $this
     */
    public function setCompletedById($completedById)
    {
        $this->completedById = $completedById;
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
