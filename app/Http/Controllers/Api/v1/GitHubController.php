<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\GitHub\GetRepositoriesService;
use App\Services\GitHub\GetRepositoryByNameService;
use App\Services\Repositories\StoreRepositoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    private GetRepositoryByNameService $get_repository_by_name_service;
    private StoreRepositoryService $store_repository_service;

    public function __construct(
        GetRepositoryByNameService $get_repository_by_name_service,
        StoreRepositoryService $store_repository_service)
    {
        $this->get_repository_by_name_service = $get_repository_by_name_service;
        $this->store_repository_service = $store_repository_service;
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
