<?php

namespace Wunderlist\Service;

use React\Promise\Promise;
use Wunderlist\ApiClient;
use Wunderlist\Entity\Membership;

class MembershipService extends AbstractService
{
    protected $userService;
    protected $baseUrl = 'memberships';
    protected $type = Membership::class;

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
        $this->userService = new UserService($client);
    }

    public function all()
    {
        return $this->get($this->getBaseUrl())->then(function ($content) {
            return $this->deserialize($content, "ArrayCollection<{$this->type}>");
        });
    }

    /**
     * @return Promise
     */
    public function mine()
    {
        return $this->userService->current()->then(function ($user) {
            return $this->forUser($user);
        });
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
