<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

class Reminder implements IdentifiableInterface
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
     * @var \DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s.uO'>")
     */
    protected $date;

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
