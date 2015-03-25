<?php

namespace Wunderlist;

use GuzzleHttp\Client;
use Wunderlist\Entity\WList;

class ListService extends ApiClient
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

    /**
     * Create a list.
     * @param WList $data List creation data.
     * @return mixed
     */
    public function create(WList $data)
    {
        return $this->post($this->getBaseUrl(), $data);
    }

    public function update(WList $data)
    {
        return $this->patch('lists', $data->getId(), $data);
    }

    public function makePublic($id)
    {
        return $this->patch('lists', $id, [
            'public' => true
        ]);
    }

    public function makePrivate($id)
    {
        return $this->patch('lists', $id, [
            'public' => false
        ]);
    }
}