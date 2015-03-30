<?php

namespace Wunderlist\Entity;

use JMS\Serializer\Annotation\Type;

abstract class AbstractPosition implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;

    /**
     * @var array
     * @Type("array")
     */
    protected $values;

    /**
     * @var string
     * @Type("string")
     */
    protected $type;

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
