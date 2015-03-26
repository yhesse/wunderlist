<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\User;

class UserService extends AbstractService
{
    protected $baseUrl = 'users';
    protected $type = User::class;

    public function all()
    {
        $data = $this->get($this->getBaseUrl());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function current()
    {
        $data = $this->get('user');
        return $this->deserialize($data, $this->type);
    }
}
