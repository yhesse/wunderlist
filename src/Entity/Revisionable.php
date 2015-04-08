<?php

namespace Wunderlist\Entity;

trait Revisionable
{
    /**
     * @var integer
     * @JMS\Serializer\Annotation\Type\Type("integer")
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
