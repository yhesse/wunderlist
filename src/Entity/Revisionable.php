<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

trait Revisionable
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $revision;

    /**
     * @return integer
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param integer $revision
     * @return $this
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
        return $this;
    }
}
