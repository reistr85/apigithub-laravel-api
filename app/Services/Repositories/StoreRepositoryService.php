<?php

namespace App\Services\Repositories;

use App\Models\Repository;

class StoreRepositoryService
{
    /**
     * @param array $data
     * @return array
     */
    public function execute(array $data): array
    {
        return Repository::create($data)->toArray();
    }
}
