<?php

namespace App\Controller;

use App\Exception\ApiStatsException;
use App\Exception\ApiUsersException;
use App\Service\SearchRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $searchRequestService;

    public function __construct(SearchRequestService $searchRequestService)
    {
        $this->searchRequestService = $searchRequestService;
    }

    /**
     * @Route("/api/stats", name="api_stats")
     */
    public function stats()
    {
        $stats = [];
        $message = "";

        try {
            $code = Response::HTTP_OK;
            $error = false;

            $stats = $this->searchRequestService->getApiStats();

            if (is_null($stats)) {
                $stats = [];
            }

        } catch (ApiStatsException $exception) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $error = true;
            $message = $exception->getMessage();
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == Response::HTTP_OK ? $stats : $message,
        ];

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/users", name="api_users")
     */
    public function users()
    {
        $users = [];
        $message = "";

        try {
            $code = Response::HTTP_OK;
            $error = false;

            $users = $this->searchRequestService->getApiUsers();

            if (is_null($users)) {
                $users = [];
            }

        } catch (ApiUsersException $exception) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $error = true;
            $message = $exception->getMessage();
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == Response::HTTP_OK ? $users : $message,
        ];

        return new JsonResponse($response);
    }
}
