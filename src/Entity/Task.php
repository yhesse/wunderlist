<?php

namespace Wunderlist\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

class Task extends AbstractTask
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $assigneeId;

    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s.uO'>")
     */
    protected $dueDate;

    /**
     * @var integer
     * @Type("integer")
     */
    protected $listId;

    /**
     * @var boolean
     * @Type("boolean")
     */
    protected $starred;

    /**
     * @var ArrayCollection
     * @Type("ArrayCollection<Wunderlist\Entity\Subtask>")
     */
    protected $subtasks;

    public function __construct()
    {
        $this->subtasks = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getAssigneeId()
    {
        return $this->assigneeId;
    }

    /**
     * @param integer $assigneeId
     * @return $this
     */
    public function setAssigneeId($assigneeId)
    {
        $this->assigneeId = $assigneeId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param integer $listId
     * @return $this
     */
    public function setListId($listId)
    {
        $this->listId = $listId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     * @return $this
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getStarred()
    {
        return $this->starred;
    }

    /**
     * @param boolean $starred
     * @return $this
     */
    public function setStarred($starred)
    {
        $this->starred = $starred;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubtasks()
    {
        return $this->subtasks;
    }

    /**
     * @param ArrayCollection $subtasks
     * @return $this
     */
    public function setSubtasks($subtasks)
    {
        $this->subtasks = $subtasks;
        return $this;
    }

    /**
     * @param Subtask $subtask
     * @return $this
     */
    public function addSubtask(Subtask $subtask)
    {
        $this->subtasks->add($subtask);
        return $this;
    }

    /**
     * @param Subtask $subtask
     * @return $this
     */
    public function removeSubtask(Subtask $subtask)
    {
        $this->subtasks->remove($subtask);
        return $this;
    }
}
