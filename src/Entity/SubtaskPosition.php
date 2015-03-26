<?php

namespace Wunderlist\Entity;

class SubtaskPosition extends AbstractPosition
{
    /**
     * @var integer
     */
    protected $taskID;

    /**
     * @var integer
     */
    protected $listID;

    /**
     * @return int
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param int $listID
     * @return $this
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaskID()
    {
        return $this->taskID;
    }

    /**
     * @param int $taskID
     * @return $this
     */
    public function setTaskID($taskID)
    {
        $this->taskID = $taskID;
        return $this;
    }
}
