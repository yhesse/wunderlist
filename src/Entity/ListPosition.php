<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

class ListPosition extends AbstractPosition
{
    /**
     * @var integer
     * @Type("integer")
     */
    protected $listId;

    /**
     * @return int
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param int $listId
     * @return $this
     */
    public function setListId($listId)
    {
        $this->listId = $listId;
        return $this;
    }
}
