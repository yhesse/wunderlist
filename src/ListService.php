<?php

namespace Wunderlist;

use GuzzleHttp\Client;
use Wunderlist\Entity\WList;

class ListService extends AbstractService
{
    protected $membershipService;
    protected $baseUrl = 'lists';
    protected $type = WList::class;

    public function __construct(Client $client, $params)
    {
        parent::__construct($client, $params);
        $this->membershipService = new MembershipService($client, $params);
    }

    public function all()
    {
        $data = $this->get($this->getBaseUrl());
        return $this->deserialize($data, "ArrayCollection<{$this->type}>");
    }

    public function accepted()
    {
        $myMemberships = $this->membershipService->mine();
        $acceptedMemberships = $myMemberships->filter(function ($membership) {
            return $membership->getState() === 'accepted';
        });

        $acceptedIDs = $acceptedMemberships->map(function ($acceptedMembership) {
            return $acceptedMembership->getListId();
        });

        $allLists = $this->all();
        $myLists = $allLists->filter(function ($list) use ($acceptedIDs) {
            return $acceptedIDs->indexOf($list->getId());
        });

        return $myLists;
    }

    public function getTaskCounts($list)
    {
        return $this->client->get($this->getBaseUrl() . '/tasks_count', [
            'query' => [
                'list_id' => $list
            ]
        ])->json();
    }

    public function makePublic(WList $data)
    {
        return $this->patch($this->getBaseUrl(), $data->getId(), [
            'public' => true
        ]);
    }

    public function makePrivate(WList $data)
    {
        return $this->patch($this->getBaseUrl(), $data->getId(), [
            'public' => false
        ]);
    }
}