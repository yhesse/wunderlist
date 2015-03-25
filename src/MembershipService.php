<?php

namespace Wunderlist;

use GuzzleHttp\Client;
use Wunderlist\Entity\Membership;

class MembershipService extends ApiClient
{
    protected $userService;
    protected $baseUrl = 'memberships';
    protected $type = Membership::class;

    public function __construct(Client $client, $params)
    {
        parent::__construct($client, $params);
        $this->userService = new UserService($client, $params);
    }

    public function all()
    {
        $data = $this->get($this->getBaseUrl());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function mine()
    {
        $user = $this->userService->current();
        return $this->forUser($user);
    }

    public function addMemberToList($list, $user, $muted = false)
    {
        return $this->post($this->getBaseUrl(), [
            'list_id' => $list,
            'user_id' => $user,
            'muted' => $muted
        ]);
    }

    public function acceptMember($id, $revision, $muted = false)
    {
        return $this->post($this->getBaseUrl(), $id, [
            'revision' => $revision,
            'state' => 'accepted',
            'muted' => $muted
        ]);
    }

    public function rejectMember($id, $revision, $muted = false)
    {
        return $this->delete($this->getBaseUrl(), $id, [
            'revision' => $revision,
            'state' => 'accepted',
            'muted' => $muted
        ]);
    }
}