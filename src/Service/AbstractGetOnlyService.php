<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Exception\NotAllowedException;

abstract class AbstractGetOnlyService extends AbstractService
{
    public function create($entity, $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function update(IdentifiableInterface $entity, $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function patch($id, $data, $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function delete(IdentifiableInterface $entity, $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

}
