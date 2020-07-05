<?php

namespace App\Controller;

use App\Entity\SearchRequest;
use App\Form\SearchRequestType;
use App\Service\SearchRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $searchRequestService;

    public function __construct(SearchRequestService $searchRequestService)
    {
        $this->searchRequestService = $searchRequestService;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $searchRequest = new SearchRequest();

        $form = $this->createForm(SearchRequestType::class, $searchRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->get('city')->getData();

            $demographics = $this->searchRequestService->handleSearchRequest($city);
            $cachedTime = isset($demographics['cached_time'])
                ? isset($demographics['cached_time'])
                : (new \DateTime())->format('Y-m-d H:i:s');

            $lastSearchRequests = $this->searchRequestService->getLastSearchRequests();

            return $this->render('index/index.html.twig', [
                'form' => $form->createView(),
                'demographics' => $demographics,
                'cachedTime' => $cachedTime,
                'lastSearchRequests' => $lastSearchRequests,
            ]);
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'demographics' => [],
            'lastSearchRequests' => [],
        ]);
    }
}
