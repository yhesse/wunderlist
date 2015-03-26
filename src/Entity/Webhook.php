<?php

namespace Wunderlist\Entity;

class Webhook implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var integer
     */
    protected $listID;

    /**
     * @var integer
     */
    protected $membershipID;

    /**
     * @var string
     */
    protected $membershipType;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $processorType;

    /**
     * @var string
     */
    protected $configuration;

    /**
     * @return int
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param int $listID
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
        return $this;
    }

    /**
     * @return int
     */
    public function getMembershipID()
    {
        return $this->membershipID;
    }

    /**
     * @param int $membershipID
     * @return $this
     */
    public function setMembershipID($membershipID)
    {
        $this->membershipID = $membershipID;
        return $this;
    }

    /**
     * @return string
     */
    public function getMembershipType()
    {
        return $this->membershipType;
    }

    /**
     * @param string $membershipType
     * @return $this
     */
    public function setMembershipType($membershipType)
    {
        $this->membershipType = $membershipType;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getProcessorType()
    {
        return $this->processorType;
    }

    /**
     * @param string $processorType
     * @return $this
     */
    public function setProcessorType($processorType)
    {
        $this->processorType = $processorType;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param string $configuration
     * @return $this
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }
}
