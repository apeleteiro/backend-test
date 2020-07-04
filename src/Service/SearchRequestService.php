<?php

namespace App\Service;

use App\Entity\SearchRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Security\Core\Security;

class SearchRequestService
{
    const API_ENTRY_POINT = 'https://public.opendatasoft.com/api/records/1.0/search/?dataset=us-cities-demographics&q=&facet=city&facet=state&facet=race&refine.city=';

    private $manager;
    private $security;

    public function __construct(EntityManagerInterface $manager, Security $security)
    {
        $this->manager = $manager;
        $this->security = $security;
    }

    public function handleSearchRequest($city)
    {
        $apiUrl = self::API_ENTRY_POINT . $city;

        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $apiUrl);

        if (count($response->toArray()['records']) > 0) {
            $content = $response->toArray();

            /** @var User $user */
            $user = $this->security->getUser();

            $searchRequest = new SearchRequest();
            $searchRequest->setCity($city);
            $searchRequest->setDate(new \DateTime());
            $searchRequest->setUser($user);
            $this->manager->persist($searchRequest);
            $this->manager->flush();

            dump($content['records'][0]['fields']);
        }
    }
}