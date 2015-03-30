<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\User;

class UserService extends AbstractService
{
    protected $baseUrl = 'users';
    protected $type = User::class;

    public function all()
    {
        return $this->get($this->getBaseUrl(), "ArrayCollection<{$this->type}>");
    }

    public function current()
    {
        return $this->get('user', $this->type);
    }
}
