<?php

namespace Wunderlist\Service;

use Collections\ArrayList;
use React\Promise\Promise;
use Wunderlist\ApiClient;
use Wunderlist\Entity\Membership;
use Wunderlist\Entity\WList;

class ListService extends AbstractService
{
    protected $membershipService;
    protected $baseUrl = 'lists';
    protected $type = WList::class;

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
        $this->membershipService = new MembershipService($client);
    }

    /**
     * @return Promise
     */
    public function all()
    {
        return $this->get($this->getBaseUrl())->then(function ($data) {
            return new ArrayList($this->deserialize($data, "ArrayCollection<{$this->type}>"));
        });
    }

    /**
     * @return Promise
     */
    public function accepted()
    {
        return $this->membershipService->mine()
            ->then(function ($myMemberships) {
                return $myMemberships->filter(function (Membership $membership) {
                    return $membership->getState() === 'accepted';
                });
            })->then(function ($acceptedMemberships) {
                return $acceptedMemberships->map(function (Membership $acceptedMembership) {
                    return $acceptedMembership->getListId();
                });
            })->then(function ($acceptedIDs) {
                return $this->all()->then(function ($allLists) use ($acceptedIDs) {
                    return $allLists->filter(function (WList $list) use ($acceptedIDs) {
                        return $acceptedIDs->indexOf($list->getId());
                    });
                });
            });
    }

    /**
     * @return Promise
     */
    public function makePublic(WList $data)
    {
        return $this->patch($data->getId(), [
            'public' => true
        ]);
    }

    /**
     * @return Promise
     */
    public function makePrivate(WList $data)
    {
        return $this->patch($data->getId(), [
            'public' => false
        ]);
    }
}
