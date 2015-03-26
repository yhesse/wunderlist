<?php

namespace Wunderlist\Entity;

class TaskPosition extends AbstractPosition
{
    /**
     * @var integer
     */
    protected $taskID;

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
