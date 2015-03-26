<?php

namespace Wunderlist\Entity;

class Note implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var integer
     */
    protected $taskID;

    /**
     * @var string
     */
    protected $content;

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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}
