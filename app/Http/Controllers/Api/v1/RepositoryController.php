<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CreateRepositoryRequest;
use App\Models\Repository;
use App\Services\Repositories\GetAllRepositoriesService;
use App\Services\Repositories\StoreRepositoryService;
use App\Services\Repositories\UpdateByIdRepositoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepositoryController extends Controller
{

    private $store_repository_service;
    private $get_all_repositories_service;
    private $update_by_id_repository_service;

    public function __construct(
        StoreRepositoryService $store_repository_service,
        GetAllRepositoriesService $get_all_repositories_service,
        UpdateByIdRepositoryService $update_by_id_repository_service)
    {
        $this->store_repository_service = $store_repository_service;
        $this->get_all_repositories_service = $get_all_repositories_service;
        $this->update_by_id_repository_service = $update_by_id_repository_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $repositories = $this->get_all_repositories_service->execute();

            return response()->json([$repositories], 200);
        }catch(Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRepositoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateRepositoryRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $repository = $this->store_repository_service->execute($data);

            return response()->json([$repository], 201);
        }catch(Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->all();
            $repository = $this->update_by_id_repository_service->execute($id, $data);

            return response()->json([$repository], 200);
        }catch(Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
