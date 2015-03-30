<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

trait Timestampable
{
    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s.uO'>")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s.uO'>")
     */
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
