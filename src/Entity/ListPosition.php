<?php

namespace Wunderlist\Entity;

class ListPosition extends AbstractPosition
{

    /**
     * @var integer
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
}
