<?php

namespace App\Services\Repositories;

use App\Models\Repository;
use Exception;

class StoreRepositoryService
{

    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return array
     * @throws \Throwable
     */
    public function execute(array $data): array
    {
        throw_if($this->repository->repositoryExistentByGitHubId($data['github_id']), new Exception('Este respositório já está favoritado!', 422));
        return Repository::create($data)->toArray();
    }
}
