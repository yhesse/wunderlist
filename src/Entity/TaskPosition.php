<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

class TaskPosition extends AbstractPosition
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $taskId;

    /**
     * @return int
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     * @return $this
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        return $this;
    }
}
