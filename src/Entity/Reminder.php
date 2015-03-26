<?php

namespace Wunderlist\Entity;

class Reminder implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var integer
     */
    protected $taskID;

    /**
     * @var \DateTime
     */
    protected $date;

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

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
}
