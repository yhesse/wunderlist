<?php

namespace Wunderlist\Service;

use React\Promise\Promise;
use Wunderlist\Entity\User;

class UserService extends AbstractService
{
    protected $baseUrl = 'users';
    protected $type = User::class;

    public function all()
    {
        return $this->get($this->getBaseUrl())->then(function ($content) {
            return $this->deserialize($content, "ArrayCollection<{$this->type}>");
        });
    }

    /**
     * @return Promise
     */
    public function current()
    {
        return $this->get($this->getBaseUrl())->then(function ($content) {
            return $this->deserialize($content, $this->type);
        });
    }
}
