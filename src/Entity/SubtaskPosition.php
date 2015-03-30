<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

class SubtaskPosition extends AbstractPosition
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $taskId;

    /**
     * @var integer
     * @Type("integer")
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
