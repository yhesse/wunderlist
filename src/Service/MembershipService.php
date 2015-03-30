<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\Membership;
use Wunderlist\Http\AsyncGuzzleAdapter;
use Wunderlist\Http\HttpClientInterface;

class MembershipService extends AbstractService
{
    protected $userService;
    protected $baseUrl = 'memberships';
    protected $type = Membership::class;

    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client);
        $this->userService = new UserService($client);
    }

    public function all()
    {
        return $this->get($this->getBaseUrl(), "ArrayCollection<{$this->type}>");
    }

    public function mine()
    {
        if ($this->client instanceof AsyncGuzzleAdapter) {
            return $this->userService->current()->then(function ($user) {
                return $this->forUser($user);
            });
        }
        $user = $this->userService->current();
        return $this->forUser($user);
    }

    public function addMemberToList($list, $user, $muted = false)
    {
        return $this->post($this->getBaseUrl(), [
            'list_id' => $list,
            'user_id' => $user,
            'muted' => $muted
        ], '\stdClass');
    }

    public function acceptMember(Membership $membership, $muted = false)
    {
        return $this->post($this->getBaseUrl() . '/' . $membership->getId(), [
            'json' => [
                'revision' => $membership->getRevision(),
                'state' => 'accepted',
                'muted' => $muted
            ]
        ], '\stdClass');
    }

    public function rejectMember(Membership $membership, $muted = false)
    {
        return $this->delete($membership, [
            'json' => [
                'revision' => $membership->getRevision(),
                'state' => 'rejected',
                'muted' => $muted
            ]
        ]);
    }
}
