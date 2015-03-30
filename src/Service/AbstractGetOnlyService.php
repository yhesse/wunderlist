<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\IdentifiableInterface;
use Wunderlist\Exception\NotAllowedException;

abstract class AbstractGetOnlyService extends AbstractService
{
    public function create($entity, array $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function update(IdentifiableInterface $entity, array $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function patch($id, $data, $type, array $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }

    public function delete(IdentifiableInterface $entity, array $options = [])
    {
        throw new NotAllowedException(_('Method not allowed for this service.'));
    }
}
