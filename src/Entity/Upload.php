<?php

namespace Wunderlist\Entity;

class Upload implements IdentifiableInterface
{
    use Revisionable,
        Identifiable,
        Timestampable;
}
