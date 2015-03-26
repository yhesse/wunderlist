<?php

namespace Wunderlist\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Task extends AbstractTask
{
    /**
     * @var integer
     */
    protected $assigneeID;

    /**
     * @var \DateTime
     */
    protected $dueDate;

    /**
     * @var integer
     */
    protected $listID;

    /**
     * @var boolean
     */
    protected $starred;

    /**
     * @var ArrayCollection
     */
    protected $subtasks;

    public function __construct()
    {
        $this->subtasks = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getAssigneeID()
    {
        return $this->assigneeID;
    }

    /**
     * @param integer $assigneeID
     * @return $this
     */
    public function setAssigneeID($assigneeID)
    {
        $this->assigneeID = $assigneeID;
        return $this;
    }

    /**
     * @return integer
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param integer $listID
     * @return $this
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
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
