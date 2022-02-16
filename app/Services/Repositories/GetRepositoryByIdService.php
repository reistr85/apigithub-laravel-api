<?php

namespace App\Services\Repositories;

use App\Models\Repository;
use Exception;

class GetRepositoryByIdService
{
    /**
     * @param int $id
     * @return array
     * @throws \Throwable
     */
    public function execute(int $id): array
    {
        $repository = Repository::find($id);
        throw_unless($repository, new Exception('Registro não localizado.', 422));

        return $repository->toArray();
    }
}
