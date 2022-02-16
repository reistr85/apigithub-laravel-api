<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\GitHub\GetRepositoriesService;
use App\Services\GitHub\GetRepositoryByNameService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GitHubController extends Controller
{

    private GetRepositoriesService $get_repositories_service;
    private GetRepositoryByNameService $get_repository_by_name_service;

    public function __construct(
        GetRepositoriesService $get_repositories_service,
        GetRepositoryByNameService $get_repository_by_name_service)
    {
        $this->get_repositories_service = $get_repositories_service;
        $this->get_repository_by_name_service = $get_repository_by_name_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $repositories = $this->get_repositories_service->execute();

            return response()->json([$repositories], 200);
        }catch(Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getRepositoryByName(Request $request): JsonResponse
    {
        try {
            $data = $request->only('name');
            $repository = $this->get_repository_by_name_service->execute($data['name']);

            return response()->json([$repository], 200);
        }catch(Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 500);
        }
    }
}
