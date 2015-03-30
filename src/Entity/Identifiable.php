<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

trait Identifiable
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $id;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
