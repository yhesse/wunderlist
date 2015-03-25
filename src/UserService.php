<?php

namespace Wunderlist;

use Wunderlist\Entity\User;

class UserService extends ApiClient
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

    /**
     * Create a user.
     * @param User $data List creation data.
     * @return mixed
     */
    public function create(User $data)
    {
        return $this->post($this->getBaseUrl(), $data);
    }

    public function update(User $data)
    {
        return $this->patch('lists', $data->getId(), $data);
    }
}
