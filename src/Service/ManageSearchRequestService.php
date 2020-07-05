<?php

namespace App\Service;

use App\Entity\SearchRequest;
use Doctrine\ORM\EntityManagerInterface;

class ManageSearchRequestService
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function manageSearchRequest($response, $user)
    {
        $searchRequest = new SearchRequest();
        $searchRequest->setCity($response['records'][0]['fields']['city']);
        $searchRequest->setDate(new \DateTime());
        $searchRequest->setUser($user);
        $this->manager->persist($searchRequest);
        $this->manager->flush();
    }
}
