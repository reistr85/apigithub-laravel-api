<?php

namespace App\Services\Repositories;

use App\Models\Repository;

class GetAllRepositoriesService
{
    /**
     * @return array
     */
    public function execute(): array
    {
        return Repository::all()->toArray();
    }
}
