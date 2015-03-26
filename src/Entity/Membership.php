<?php

namespace Wunderlist\Entity;


class Membership implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    protected $userID;
    protected $listID;
    protected $state;
    protected $type;
    protected $owner;
    protected $muted;

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     * @return $this
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param mixed $listID
     * @return $this
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMuted()
    {
        return $this->muted;
    }

    /**
     * @param mixed $muted
     * @return $this
     */
    public function setMuted($muted)
    {
        $this->muted = $muted;
        return $this;
    }
}
