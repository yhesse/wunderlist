<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\Avatar;

class AvatarService extends AbstractGetOnlyService
{
    protected $baseUrl = 'avatar';
    protected $type = Avatar::class;
}
